<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Provinces;

class ProvinceController extends Controller
{
    public function getFullProvince(Request $request){
        try {
            $res=[];
            if($request->input('type')=='treeData'){
                $res = Provinces::with('children')->whereNull('ProvinceParent')->get()->toArray();
            }elseif ($request->input('type')=='data'){
                $res = Provinces::get()->toArray();
            }elseif ($request->input('type')=='province'){
                $res = Provinces::whereNull('ProvinceParent')->get()->toArray();
            }elseif ($request->input('type')=='district'){
                $provinceParent=$request->input('ProvinceCode');
                $res = Provinces::where('ProvinceParent',$provinceParent)->get()->toArray();
            }elseif ($request->input('type')=='commune'){
                $provinceParent=$request->input('ProvinceCode');
                $res = Provinces::where('ProvinceParent',$provinceParent)->get()->toArray();
            }
            return response()->json(['success'=>true, 'data'=>$res]);
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'mess'=>$e]);
        }

    }

}
