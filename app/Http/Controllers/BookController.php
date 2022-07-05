<?php

namespace App\Http\Controllers;

use App\Http\Requests\Books\BookRequest;
use App\Http\Requests\Books\BookUpdateRequest;
use App\Models\Books;
use App\Services\BookService;
use Exception;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(BookService $bookService)
    {
        $this->mainService = $bookService;
        $this->default_data = [
            'title'      => 'Books',
            'header'     => 'Books',
            'sub_header' => 'Books',
            'route'      => 'master.books.',
        ];
    }

    public function index(){
        return view($this->default_data['route'].'index', $this->default_data)->with('success', 'Success');
    }

    public function getData(Request $request){
        $query = $this->mainService->getDataTable($request);
        return $query;
    }

    public function create(){
        return view($this->default_data['route'].'create', $this->default_data);
    }

    public function store(BookRequest $request){
        try {
            $this->mainService->store($request);
            return redirect(route($this->default_data['route'].'index'))->with('success', 'Success');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($data_id){
        try {
            $this->default_data['data'] = $this->mainService->edit($data_id);
            return view($this->default_data['route'].'update', $this->default_data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(BookUpdateRequest $request, Books $books){
        try {
            $this->mainService->update($request, $books->first());
            return redirect(route($this->default_data['route'].'index'))->with('success', 'Success');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($book_id){
        try{
            $this->mainService->destroy($book_id);
            $message = 'Sukses';
            $response = [
                'message' => $message,
                'status'   => true,
            ];
            return response()->json($response);
        }catch(Exception $e){
            $message =  $e;
            $response = [
                'message' => $message,
                'status'   => false,
            ];
            return response()->json($response);
        }
    }
}
