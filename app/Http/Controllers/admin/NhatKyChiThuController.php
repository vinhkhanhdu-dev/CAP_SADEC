<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\nhatkychithu;
use Illuminate\Http\JsonResponse;
use App\Services\QueryService;

class NhatKyChiThuController extends Controller
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
            $queryService = new QueryService(new nhatkychithu());
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
            $res = nhatkychithu::create($formData);
            return response()->json(['success' => true, 'mess' => 'Thêm mới thành công!', 'data' => $res]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'mess' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $res = nhatkychithu::find($id);
            return response()->json(['success' => true, 'data' => $res]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'mess' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $formData = $request->post();
            $res = nhatkychithu::find($id)->update($formData);
            return response()->json(['success' => true, 'mess' => 'Cập nhật thành công!', 'data' => $res]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'mess' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $res = nhatkychithu::find($id)->delete();
            return response()->json(['success' => true, 'mess' => 'Xóa thành công!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'mess' => $e->getMessage()]);
        }
    }
    public function genCode(){
        $lastCode = nhatkychithu::orderBy('code', 'desc')->first(); // lấy mã cuối cùng trong database      
        if (!$lastCode) {
            $number = 1;
        } else {
            $number = intval(substr($lastCode->code, -3)) + 1; // lấy số cuối cùng của mã và tăng giá trị lên 1
        }    
        $newCode = 'CT' . str_pad($number, 4, '0', STR_PAD_LEFT); // tạo mã mới dựa trên số đó và định dạng "ABCXXX"
        return $newCode;
    }
}