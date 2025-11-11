<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\task;
use Illuminate\Http\JsonResponse;
use App\Services\QueryService;

class taskController extends Controller
{
    public function index(Request $request)
    {
        try {
            $limit = $request->get('PageLimit', 25);
            $page = $request->get('Page', 1);
            $ascending = (int) $request->get('ascending', 0);
            $orderBy = $request->get('orderBy', '');
            $search = $request->get('TextSearch', '');
            $columnSearch = $request->get('columnSearch', ['tenDonVi']);
            $betweenDate = $request->get('updated_at', []);
            $queryService = new QueryService(new task());
            $queryService->columnSearch = $columnSearch;
            $queryService->search = $search;
            $queryService->betweenDate = $betweenDate;
            $queryService->limit = $limit;
            $queryService->ascending = $ascending;
            $queryService->orderBy = $orderBy;                   
            $query = $queryService->queryTable();
            $query = $query->paginate($limit,['*'],'page',$page);    
            $product = $query->toArray();
            return $this->jsonTable($product);  
          
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'mess' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $formData = $request->post();
            $res = task::create($formData);
            return response()->json(['success' => true, 'mess' => 'Thêm mới thành công!', 'data' => $res]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'mess' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $res = task::find($id);
            return response()->json(['success' => true, 'data' => $res]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'mess' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $formData = $request->post();
            $res = task::find($id)->update($formData);
            return response()->json(['success' => true, 'mess' => 'Cập nhật thành công!', 'data' => $res]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'mess' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $res = task::find($id)->delete();
            return response()->json(['success' => true, 'mess' => 'Xóa thành công!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'mess' => $e->getMessage()]);
        }
    }
    public function genCode(){
        $lastCode = task::orderBy('taskCode', 'desc')->first(); // lấy mã cuối cùng trong database      
        if (!$lastCode) {
            $number = 1;
        } else {
            $number = intval(substr($lastCode->taskCode, -3)) + 1; // lấy số cuối cùng của mã và tăng giá trị lên 1
        }    
        $newCode = 'TS' . str_pad($number, 4, '0', STR_PAD_LEFT); // tạo mã mới dựa trên số đó và định dạng "ABCXXX"
        return $newCode;
    }
}