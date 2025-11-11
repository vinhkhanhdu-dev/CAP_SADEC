<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function UpdateSetting(Request $request){
        try {
            $path = 'config/appConfig.json';
            $jsonString = file_get_contents(public_path($path));

            $data = json_decode($jsonString,true);
            $formData = $request->input();
            $formData['DEBUG_APP']&& $data['DEBUG_APP']= ($formData['DEBUG_APP']=='false'?false:true);
            // Convert JSON data from an array to a string
            $jsonString = $data;

            // Write in the file
            file_put_contents(public_path($path), json_encode($jsonString));
            return response()->json(['success'=>true, 'mess'=>'Cập nhật setting thành công!']);
        }catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
    public function UpdateAllSetting(Request $request){
        try {
            $path = 'config/appConfig.json';
            $jsonString = file_get_contents(public_path($path));

            $data = json_decode($jsonString,true);
            $formData = $request->input();
            $formData['data']&& $data= ($formData['data']);
            // Convert JSON data from an array to a string
            $jsonString = json_decode($data);
//            dd($jsonString);
            // Write in the file
            file_put_contents(public_path($path), json_encode($jsonString));
            return response()->json(['success'=>true, 'mess'=>'Cập nhật setting thành công!']);
        }catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
    public function fetchSetting(){
        $path = 'config/appConfig.json';
        $jsonString = file_get_contents(public_path($path));
        $data = json_decode($jsonString,true);
        return response()->json(['success'=>true, 'data'=>$data]);
    }
}
