<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;

class UploadController extends Controller
{
    public function upload(Request $request){
        $file= $request->file('file');
        $fileName ='file'.explode('.',$file->getClientOriginalName())[0].time().'.'.$file->extension();
        if($file->move(public_path('uploads/filemanager'), $fileName)){
            return response()->json(['success'=>true,'path'=>'/uploads/filemanager/'.$fileName]);
        }
    }
    public function removeFile(Request $request){
        $path = $request->post('path');
        if(File::delete(public_path($path))){
            return response()->json(['success'=>true,'mess'=>'Xóa file thành công']);
        }else{
            return response()->json(['success'=>true,'mess'=>'Xóa file thất bại']);
        }
    }
}
