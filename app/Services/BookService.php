<?php
namespace App\Services;

use App\Http\Controllers\GlobalController\GlobalUploadController;
use App\Models\Books;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class BookService {
    public function store($request){
        try {
            $data = $this->setDataBooksCreate($request);
            $query = Books::create($data);
            return $query;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function setDataBooksCreate($request){
        $return = [
            'name'        => $request->all()['name'],
            'description' => $request->all()['description'],
            'image'       => GlobalUploadController::upload($request->all()['images'], 'public/images/') ,
        ];
        return $return;
    }

    public function setDataBooksUpdate($request, $data){
        $return = [
            'name'        => $request->all()['name'],
            'description' => $request->all()['description'],
            'image'       => empty( $request->all()['images'] ) ? $data->image :  GlobalUploadController::uploadAndUpdate($request->all()['images'], 'public/images/', $data->image) ,
        ];
        return $return;
    }

    public function getDataTable($request){
        $get_books = Books::select('name', 'description', 'id');
        $find['name']           = ['LIKE'];
        $find['description']    = ['LIKE'];

        $data['records'] = [];
        $sort = $request->all()['order'];
        if ($sort) {
            if($request->all()['order'][0]['column'] != '0'){
                $get_books->orderBy($request->all()['columns'][$request->all()['order'][0]['column']]['data'], $request->all()['order'][0]['dir']);
            }
        }

        $search = $request->all()['search']['value'];
        if (!empty($search)) {
            foreach ($find as $value => $param) {
                if ($param != '') {
                    $operator   = $param[0];
                    $field      = $value;
                    if ($operator == 'LIKE') {
                        $get_books->orwhere($field, $operator, '%' . $search . '%');
                    } else {
                        $get_books->where($field, $operator, $search);
                    }
                }
            }
        }
        $return['recordsFiltered'] = $get_books->count();

        $start = $request->all()['start'];
        $limit = $request->all()['length'];
        $awal  = $start;
        $i     = 1 + $awal;

        $get_books->offset($awal);
        if($limit == '-1'){
            $get_books->limit($return['recordsFiltered']);
        }else{
            $get_books->limit($limit);
        }

        $get_books = $get_books->get();
        foreach($get_books as $key => $value){
            $data_id = $value->id;
            $btn_update = "<a href='".route('master.books.edit',[$data_id])."' class='btn btn-sm btn-warning btn-edit mr-1 mt-1'><i class='fas fa-pen'></i> Edit</a>";
            $btn_delete = "<a href='javascript:;' data-route='". URL::to('master/books/delete', [$data_id]) ."' class='btn btn-danger btn-sm btn-delete mt-1'><i class='fas fa-trash'></i> Delete</a>";
            $data['records'][] = [
                'no'                => (string)$i,
                'name'              => $value->name,
                'description'       => $value->description,
                'action'            => $btn_update . $btn_delete,
            ];
            $i++;
        }

        $return['recordsTotal'] = collect($get_books)->count();
        $return['data'] = $data['records'];
        return $return;
    }

    public function edit($data_id){
        $query = Books::where('id', $data_id)->first();
        return $query;
    }

    public function update($request, $books){
        $query = $books->update($this->setDataBooksUpdate($request, $books));
        return $query;
    }

    public function destroy($books_id){
        $data = Books::where('id', $books_id)->first();
        GlobalUploadController::deleteFile('public/images', $data->image);
        $query = $data->delete();
        return $query;
    }
}
