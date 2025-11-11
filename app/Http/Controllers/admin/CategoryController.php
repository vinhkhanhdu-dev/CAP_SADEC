<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Categorys;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->input('type')=='treeData'){
            $column=['*'];         
            $request->input('column') && $column =   $request->input('column');            
            $res = Categorys::select($column)->with('children')->whereNull('idParent')->get()->toArray();
        }else{
            $res = Categorys::all()->toArray();
        }
        if($res){
            return response()->json(['success'=>true, 'data'=>$res]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        try{
            $form= $request->post();
            $file = $request->file('img');
            if($file){
                $form['img']= $this->upoadFile($file);
            }
            $res = Categorys::create($form);
            if($res){
                return response()->json(['success'=>true, 'mess'=>'Thêm mới thành công!']);
            }else{
                return response()->json(['success'=>false, 'mess'=>'Thêm mới thất bại!']);
            }
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'mess'=>$e]);
        }

    }

    // uploadFile
    public function upoadFile($file){
        $fileName ='banner_'.time().'.'.$file->extension();
        if($file->move(public_path('uploads/banners'), $fileName)){
            return '/uploads/banners/'.$fileName;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try{
            $res = Categorys::find($id);
            if($res){
                return response()->json(['success'=>true, 'data'=>$res]);
            }else{
                return response()->json(['success'=>false, 'mess'=>'Danh mục đang tìm không tồn tại!']);
            }
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'mess'=>$e]);
        }
    }

    private $arrayCategory=[];

    public function getParent($id)
    {
        # code...

        try{
            $res = Categorys::find($id)->toArray();
            if($res['idParent']){
                $this->getParent($res['idParent']);
            }
            // $this->arrayCategory = $res['id'];
            // return $res['id'];
            array_push($this->arrayCategory,$res['title']);
            return response()->json(['success'=>true, 'data'=>$this->arrayCategory]);
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'mess'=>$e]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try{
            $formData = $request->post();
            $file = $request->file('img');
            if($file){
                $formData['img']= $this->upoadFile($file);
            }
            $res = Categorys::find($id)->update($formData);
            if($res){
                return response()->json(['success'=>true, 'mess'=>'Cập nhật dữ liệu thành công']);
            }else{
                return response()->json(['success'=>false, 'mess'=>'Cập nhật thất bại!']);
            }
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'mess'=>$e]);
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            $res = Categorys::find($id)->delete();
            if($res){
                return response()->json(['success'=>true, 'mess'=>'Xóa dữ liệu thành công!']);
            }else{
                return response()->json(['success'=>false, 'mess'=>'Xóa dữ liệu thất bại!']);
            }
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'mess'=>$e]);
        }
    }
}
