<?php

namespace App\Http\Controllers\GlobalController;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GlobalUploadController extends Controller
{
    public static function upload($file, $dir){
        $get_file = $file;
        if(!empty($get_file)){
            $name = time()."_".$file->getClientOriginalName();
            Storage::putFileAs($dir, $get_file, $name );
            return $name;
        }
        return null;
    }

    public static function uploadAndUpdate($file, $dir, $old_file){
        $delete_file = Storage::delete($dir.$old_file);
        $get_file = $file;
        if(!empty($get_file)){
            $name = time()."_".$file->getClientOriginalName();
            Storage::putFileAs($dir, $get_file, $name );
            return $name;
        }
        return null;
    }

    public static function deleteFile($dir, $name){
        return Storage::delete($dir.$name);
    }
}
