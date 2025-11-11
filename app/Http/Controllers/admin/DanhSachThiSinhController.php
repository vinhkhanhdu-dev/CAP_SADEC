<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\danhSachThiSinhs;
use App\Models\admin\danhSachThiSinhThuocPhongThis;
use Illuminate\Http\JsonResponse;
use App\Services\QueryService;
use DB;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;
use DateTime;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\Shared\Converter;

class DanhSachThiSinhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        try {
            $limit = $request->get('limit', 25);            
            $page = $request->get('Page', 1);
            $namHocs = DB::table('danhSachThiSinhs')
            ->join('namHocs', 'danhSachThiSinhs.maNamHoc', '=', 'namHocs.maNamHoc')
            ->join('khoiThis', 'danhSachThiSinhs.maKhoiThi', '=', 'khoiThis.maKhoiThi')
            ->select(
                'namHocs.id', 'namHocs.maNamHoc', 'namHocs.tenNamHoc', 'namHocs.ghiChu',
                'khoiThis.maKhoiThi', 'khoiThis.tenKhoiThi'
            )
            ->groupBy(
                'namHocs.id', 'namHocs.maNamHoc', 'namHocs.tenNamHoc', 'namHocs.ghiChu',
                'khoiThis.maKhoiThi', 'khoiThis.tenKhoiThi'
            )
            ->paginate($limit, ['*'], 'page', $page)
            ->toArray();
          
            return $this->jsonTable([
                'data'=>$namHocs['data'],
                'total'=>count($namHocs['data'])
            ]);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    public function listThiSinhInNamHocKhoiThi(Request $request){
        try {
            $filter=[];
            $request->input('pack_status')&& array_push($filter,['pack_status','=',$request->input('pack_status')]);
            $limit = $request->get('PageLimit', 25);
            $page = $request->get('Page', 1);           
            $ascending = (int) $request->get('ascending', 0);
            $orderBy = $request->get('orderBy', '');
            $search = $request->get('TextSearch', '');
            $searchWith = $request->get('TextSearchWith', '');
            $with = $request->get('with', '');
            $itemWith = $request->get('ItemSearchWith', '');
            $columnSearch = $request->get('columnSearch', ['tenThiSinh']);
            $betweenDate = $request->get('updated_at', []);
            $queryService = new QueryService(new danhSachThiSinhs());
            $queryService->select = [];
            $queryService->filter = $filter;
            $queryService->columnSearch =$columnSearch;
            $queryService->withRelationship = ['namHoc','khoiThi'];
            $queryService->searchRelationship = $searchWith;
            $queryService->itemRelationship = $itemWith;
            $queryService->with = $with;
            $queryService->search = $search;
            $queryService->betweenDate = $betweenDate;
            $queryService->limit = $limit;
            $queryService->ascending = $ascending;
            $queryService->orderBy = $orderBy;
            $query = $queryService->queryTable();
            $maNamHoc = $request->get('maNamHoc','');
            $maKhoiThi = $request->get('maKhoiThi','');        
            $query = $query->where([['maNamHoc',$maNamHoc], ['maKhoiThi',$maKhoiThi]]);
            $query = $query->orderByRaw("LEFT(SUBSTRING_INDEX(tenThiSinh, ' ', -1), 1) ASC");            
            $query = $query->paginate($limit,['*'],'page',$page);            
            $product = $query->toArray();
            return $this->jsonTable($product);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        DB::beginTransaction();
        try{
            $formData = $request->post();
            $listThiSinh = json_decode($formData['ListThiSinh']);   
            $maNamHoc = $formData['maNamHoc'];        
            $maKhoiThi = $formData['maKhoiThi'];     
            $clear = danhSachThiSinhs::where([['maNamHoc',$maNamHoc],['maKhoiThi',$maKhoiThi]])->delete();   
            foreach($listThiSinh as $index=>$item){
               $item= (array)$item;
               $item['maNamHoc']=$maNamHoc;
               $item['maKhoiThi']=$maKhoiThi;
               $item['maThiSinh']= self::genCode();     
            //    $checkExist= danhSachThiSinhs::where([['tenThiSinh',$item['tenThiSinh']]])->first();
            //    if($checkExist == null){
               
               $res = danhSachThiSinhs::create($item);
            //    }else{
            //      $id = $checkExist->toArray()['id'];                
            //      $res = danhSachThiSinhs::find($id)->update($item);
            //    }                 
            }
            DB::commit();
            if($res){
                return response()->json(['success'=>true, 'mess'=>'Cập nhật danh sách thành công!']);
            }else{
                return response()->json(['success'=>false, 'mess'=>'Cập nhật danh sách thất bại!']);
            }
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'mess'=>$e]);
        }
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
            $res = danhSachThiSinhs::find($id);
            if($res){
                return response()->json(['success'=>true, 'data'=>$res]);
            }else{
                return response()->json(['success'=>false, 'mess'=>'Danh mục đang tìm không tồn tại!']);
            }
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
        try{
            $formData = $request->post();
            $file = $request->file('image');
            if($file){
                $formData['path']= $this->upoadFile($file);
            }
            $res = danhSachThiSinhs::find($id)->update($formData);
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
            $res = danhSachThiSinhs::find($id)->update($formData);
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
    public function destroy(Request $request)
    {
        //      
        try{       
            $maNamHoc = $request->get('maNamHoc','');
            $maKhoiThi = $request->get('maKhoiThi','');      
            $res = danhSachThiSinhs::where([
                ['maNamHoc',$maNamHoc], 
                ['maKhoiThi',$maKhoiThi],
            ])->delete();
            if($res){
                return response()->json(['success'=>true, 'mess'=>'Xóa dữ liệu thành công!']);
            }else{
                return response()->json(['success'=>false, 'mess'=>'Xóa dữ liệu thất bại!']);
            }
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'mess'=>$e]);
        }
    }
    public function genCode(){
        $lastCode = danhSachThiSinhs::orderBy('maThiSinh', 'desc')->first(); // lấy mã cuối cùng trong database      
        if (!$lastCode) {
            $number = 1;
        } else {
            $number = intval(substr($lastCode->maThiSinh, -3)) + 1; // lấy số cuối cùng của mã và tăng giá trị lên 1
        }    
        $newCode = 'SBD' . str_pad($number, 4, '0', STR_PAD_LEFT); // tạo mã mới dựa trên số đó và định dạng "ABCXXX"
        return $newCode;
    }

    public function sapPhongThi(Request $request){
        $formData = $request->post();       
        $formData['danhSachThiSinh'] = json_decode($formData['danhSachThiSinh'] );        
        $formData['monThi'] = json_decode($formData['monThi'] );
        $formData['phongThi'] = json_decode($formData['phongThi'] );

        
        if($formData['danhSachThiSinh']){
            $monThi= $formData['monThi'];
            $donVi= $formData['maDonVi'];
            $kyThi= $formData['maKyThi'];
            $students = (array)$formData['danhSachThiSinh'];
            $rooms = array( $formData['phongThi'])[0];
            $totalRooms = count($rooms);
            $totalStudents = count($students);

            // Chia đều số lượng thí sinh cho mỗi phòng
         
            $assignedRooms = [];
            $index = 0;
            $baseCount = intdiv($totalStudents, $totalRooms); // Số học sinh mỗi phòng cơ bản
            $extra = $totalStudents % $totalRooms; // Số phòng cần thêm 1 học sinh
            foreach ($rooms as $i => $room) {
                $count = $baseCount + ($i < $extra ? 1 : 0); // Phòng cuối nhận phần dư
                $studentsInRoom = array_slice($students, $index, $count);

                // Gán thông tin phòng thi vào từng học sinh
                foreach ($studentsInRoom as &$student) {
                    $student->maPhongThi = $room; // Thêm thông tin phòng thi     
                    $student->maDonVi = $donVi;               
                    $student->maKyThi = $kyThi;               
                    $assignedStudents[] = $student;
                }
            
                $index += $count;
            }           
        }
        
        $listPhongThiTheoMon=[];
        foreach($assignedStudents as $index =>$item){
            foreach($monThi as $index2 => $item2){              
                $item->maMonHoc=$item2;               
                $checkExist= danhSachThiSinhThuocPhongThis::where([
                    ['maThiSinh',$item->maThiSinh],
                    ['maKhoiThi',$item->maKhoiThi],
                    ['maNamHoc',$item->maNamHoc],
                    ['maPhongThi',$item->maPhongThi],
                    ['maMonHoc',$item->maMonHoc],
                    ['maKyThi',$item->maKyThi],
                    ['maDonVi',$item->maDonVi],
                ])->first();
                if($checkExist===null){
                     $res = danhSachThiSinhThuocPhongThis::create((array)$item);
                }else{
                    return response()->json(['success'=>false, 'mess'=>$item->maThiSinh]);
                }          
               
            }
        }
        // dd($listPhongThiTheoMon);
        return response()->json(['success'=>true, 'mess'=>'Cập nhật danh sách thành công!']);
    }


    public function getListKetQuaSapPhongThi(Request $request)
    {
        //     
        try {
            $limit = $request->get('PageLimit', 25);
            $page = $request->get('Page', 1);
            $formSearch = json_decode($request->get('formSearch'));
            $searchWhere = [];
            $data = danhSachThiSinhThuocPhongThis::with(['namHoc','khoiThi','thiSinh','kyThi','phongThi','monHoc','donVi']);
            if($formSearch && count((array)$formSearch)>0){
                foreach($formSearch as $key => $item){
                    if($item !== null && $item !==""){
                         array_push($searchWhere,[$key,$item]);
                    }                   
                }
                if($searchWhere && count($searchWhere)>0){
                     $data = $data->where($searchWhere);
                }               
            }               
            $data =$data->select('maNamHoc','maMonHoc','maPhongThi','maDonVi','maKhoiThi','maKyThi');
            $data =$data->groupBy('maNamHoc','maMonHoc','maPhongThi','maDonVi','maKhoiThi','maKyThi');
            $data =$data->paginate($limit, ['*'], 'page', $page);
            $data = $data->toArray();  
            return $this->jsonTable([
                'data' => $data['data'],
                'total' => count($data['data'])
            ]);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    public function getDanhSachThiSinhOfPhong(Request $request){
        try {
            $filter=[];
            $request->input('pack_status')&& array_push($filter,['pack_status','=',$request->input('pack_status')]);
            $limit = $request->get('PageLimit', 25);
            $page = $request->get('Page', 1);           
            $ascending = (int) $request->get('ascending', 0);
            $orderBy = $request->get('orderBy', '');
            $search = $request->get('TextSearch', '');
            $searchWith = $request->get('TextSearchWith', '');
            $with = $request->get('with', '');
            $itemWith = $request->get('ItemSearchWith', '');
            $columnSearch = $request->get('columnSearch', ['']);
            $betweenDate = $request->get('updated_at', []);
            $queryService = new QueryService(new danhSachThiSinhThuocPhongThis());
            $queryService->select = [];
            $queryService->filter = $filter;
            $queryService->columnSearch =$columnSearch;
            $queryService->withRelationship = ['namHoc','khoiThi','thiSinh','kyThi','phongThi','monHoc','donVi'];
            $queryService->searchRelationship = $searchWith;
            $queryService->itemRelationship = $itemWith;
            $queryService->with = $with;
            $queryService->search = $search;
            $queryService->betweenDate = $betweenDate;
            $queryService->limit = $limit;
            $queryService->ascending = $ascending;
            $queryService->orderBy = $orderBy;
            $query = $queryService->queryTable();
            $maNamHoc = $request->get('maNamHoc','');
            $maKhoiThi = $request->get('maKhoiThi','');        
            $maMonHoc = $request->get('maMonHoc','');        
            $maPhongThi = $request->get('maPhongThi','');        
            $maKyThi = $request->get('maKyThi','');        
            $maDonVi = $request->get('maDonVi','');        
            $query = $query->where([
                ['maNamHoc',$maNamHoc], 
                ['maKhoiThi',$maKhoiThi],
                ['maMonHoc',$maMonHoc],
                ['maPhongThi',$maPhongThi],
                ['maKyThi',$maKyThi],
                ['maDonVi',$maDonVi],
            ]);
            // $query = $query->join('danhSachThiSinhs', 'danhSachThiSinhThuocPhongThis.maThiSinh', '=', 'danhSachThiSinhs.maThiSinh');
            // $query = $query->orderByRaw("LEFT(SUBSTRING_INDEX(danhSachThiSinhs.tenThiSinh, ' ', -1), 1) ASC");            
            $query = $query->paginate($limit,['*'],'page',$page);            
            $product = $query->toArray();
            return $this->jsonTable($product);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
    public function deleteKQ(Request $request){
        try{
            $maNamHoc = $request->get('maNamHoc','');
            $maKhoiThi = $request->get('maKhoiThi','');        
            $maMonHoc = $request->get('maMonHoc','');        
            $maPhongThi = $request->get('maPhongThi','');        
            $maKyThi = $request->get('maKyThi','');        
            $maDonVi = $request->get('maDonVi','');      
            $res = danhSachThiSinhThuocPhongThis::where([
                ['maNamHoc',$maNamHoc], 
                ['maKhoiThi',$maKhoiThi],
                ['maMonHoc',$maMonHoc],
                ['maPhongThi',$maPhongThi],
                ['maKyThi',$maKyThi],
                ['maDonVi',$maDonVi],
            ])->delete();
            if($res){
                return response()->json(['success'=>true, 'mess'=>'Xóa dữ liệu thành công!']);
            }else{
                return response()->json(['success'=>false, 'mess'=>'Xóa dữ liệu thất bại!']);
            }
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'mess'=>$e]);
        }
    }
    public function importExcel(Request $request){
        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv',
        ]);
        $data = (new FastExcel)->import($request->file('file'));
        if($data && count($data)>0){
            $dataExcel =[];
            foreach($data as $index=>$item){                
                $formData['tenThiSinh'] = $item['Họ và Tên '];  
                $formData['gioiTinh'] = $item['Giới Tính '];  
                $formData['noiSinh'] = $item['Nơi Sinh'];  
                $formData['ghiChu'] = $item['Ghi Chú'];  
                $formData['ngaySinh'] = $item['Năm Sinh'];  
                $formData['CCCD'] = @$item['CCCD'];  
               
                if(@$formData['ngaySinh'] instanceof DateTime){
                    $formData['ngaySinh']=  $formData['ngaySinh']->getTimestamp(); 
                    $formData['ngaySinh']=  Carbon::createFromTimestamp($formData['ngaySinh'])->format('d/m/Y');                
                }else{
                    $formData['ngaySinh']=  Carbon::createFromFormat('d/m/Y',$formData['ngaySinh'])->format('m/d/Y');        
                }
                array_push($dataExcel, $formData);
              
            }
            return $this->jsonTable([
                'data' => $dataExcel,
                'total' => count($dataExcel)
            ]);
            
        }

    }

    public function exportMau1(Request $request){
        try {            
            $formData = $request->post();
            if(@$formData){
                $dataFill = [
                    'tenDonVi' => @$formData['tenDonVi'],
                    'tenKyThi'=> @$formData['tenKyThi'],
                    'tenPhongThi'=> @$formData['tenPhongThi'],     
                    'soLuong'=>1               
                ];
                $formData['danhSachThiSinh']=json_decode($formData['danhSachThiSinh']);
                if(@$formData['danhSachThiSinh'] && count((array)$formData['danhSachThiSinh'])){
                    $dataFill['soLuong']= count((array)$formData['danhSachThiSinh']);
                    $path = public_path('word/mau1.docx');
                    if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                    }
                    $table = new Table(array('borderSize' => 1, 'borderColor' => 'black', 'unit' => 'auto', 'width' =>  Converter::cmToTwip(16.5)));
                    $styleTitle = array('bold' => true, 'color' => 'black','alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ]);
                    $styleCenter = array('alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ]);
                    $myParagraphStyle = array('align'=>'center', 'spaceBefore'=>150, 'spaceafter' => 150);
                    $cellRowSpan = array('vMerge' => 'restart');
                    $cellRowContinue = array('vMerge' => 'continue');
                    $cellColSpan = array('gridSpan' => 3);
                    $table->addRow();
                    $table->addCell(null, $cellRowSpan)->addText("STT",$styleTitle,$myParagraphStyle);
                    $table->addCell(Converter::cmToTwip(3), $cellRowSpan)->addText("SBD",$styleTitle,$myParagraphStyle);
                    $table->addCell(Converter::cmToTwip(4), $cellRowSpan)->addText("Họ và Tên",$styleTitle,$myParagraphStyle);
                    $table->addCell(null, $cellColSpan)->addText("Môn Thi",$styleTitle,$myParagraphStyle);
                    $table->addCell(null, $cellRowSpan)->addText("Chữ ký của thí sinh",$styleTitle,$myParagraphStyle);
                    
                    $table->addRow();
                    $table->addCell(null, $cellRowContinue);
                    $table->addCell(null, $cellRowContinue);
                    $table->addCell(null, $cellRowContinue);
                    $table->addCell(Converter::cmToTwip(3))->addText("Toán",$styleTitle,$myParagraphStyle);
                    $table->addCell(Converter::cmToTwip(3))->addText("Văn",$styleTitle,$myParagraphStyle);
                    $table->addCell(Converter::cmToTwip(3))->addText("...",$styleTitle,$myParagraphStyle);
                    $table->addCell(null, $cellRowContinue);                 
                    foreach ($formData['danhSachThiSinh'] as $index =>$detail) {                                       
                        $table->addRow();
                        $table->addCell(null)->addText($index + 1, $styleCenter, $myParagraphStyle);
                        $table->addCell(null)->addText(@$detail->maThiSinh,$styleCenter, $myParagraphStyle);
                        $table->addCell(null)->addText(@$detail->thi_sinh->tenThiSinh, $styleCenter, $myParagraphStyle);
                        $table->addCell(null)->addText('',$styleCenter, $myParagraphStyle);
                        $table->addCell(null)->addText('',$styleCenter, $myParagraphStyle);
                        $table->addCell(null)->addText('', $styleCenter, $myParagraphStyle);
                        $table->addCell(null)->addText('', $styleCenter, $myParagraphStyle);
                       
                    }
                    $phpWord = new TemplateProcessor(public_path('word/mau1.docx'));
                    $phpWord->setComplexBlock('{table}', $table);
                    $phpWord->setValues($dataFill);
                    $phpWord->saveAs('word/mau1_ex.docx');
                    return response()->json(['success'=>true,'url'=> '/word/mau1_ex.docx']);
                }
                else{
                    
                    return response()->json(['success'=>false]);
                }
            }
        }catch (Exception $e){
            return response()->json(['success'=>false]);
        }
    }
    public function exportMau2(Request $request){
        try {            
            $formData = $request->post();
            if(@$formData){
                $dataFill = [
                    'tenDonVi' => @$formData['tenDonVi'],
                    'tenKyThi'=> @$formData['tenKyThi'],
                    'tenPhongThi'=> @$formData['tenPhongThi'],     
                    'soLuong'=>1               
                ];
                $formData['danhSachThiSinh']=json_decode($formData['danhSachThiSinh']);
                if(@$formData['danhSachThiSinh'] && count((array)$formData['danhSachThiSinh'])){
                    $dataFill['soLuong']= count((array)$formData['danhSachThiSinh']);
                    $path = public_path('word/mau2.docx');
                    if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                    }
                    $table = new Table(array('borderSize' => 1, 'borderColor' => 'black', 'unit' => 'auto', 'width' =>  Converter::cmToTwip(16.5)));
                    $styleTitle = array('bold' => true, 'color' => 'black','alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ]);
                    $styleCenter = array('alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ]);
                    $myParagraphStyle = array('align'=>'center', 'spaceBefore'=>150, 'spaceafter' => 150);
                    $cellRowSpan = array('vMerge' => 'restart');
                    $cellRowContinue = array('vMerge' => 'continue');
                    $cellColSpan = array('gridSpan' => 3);
                    $table->addRow();
                    $table->addCell(Converter::cmToTwip(2), $cellRowSpan)->addText("STT",$styleTitle,$myParagraphStyle);
                    $table->addCell(Converter::cmToTwip(3), $cellRowSpan)->addText("SBD",$styleTitle,$myParagraphStyle);
                    $table->addCell(Converter::cmToTwip(4), $cellRowSpan)->addText("Họ và Tên",$styleTitle,$myParagraphStyle);
                    $table->addCell(Converter::cmToTwip(3), $cellRowSpan)->addText("Năm Sinh",$styleTitle,$myParagraphStyle);
                    $table->addCell(Converter::cmToTwip(5), $cellRowSpan)->addText("Nơi Sinh",$styleTitle,$myParagraphStyle);
                                
                    foreach ($formData['danhSachThiSinh'] as $index =>$detail) {                                       
                        $table->addRow();
                        $table->addCell(null)->addText($index + 1, $styleCenter, $myParagraphStyle);
                        $table->addCell(null)->addText(@$detail->maThiSinh,$styleCenter, $myParagraphStyle);
                        $table->addCell(null)->addText(@$detail->thi_sinh->tenThiSinh, $styleCenter, $myParagraphStyle);
                        $table->addCell(null)->addText('',$styleCenter, $myParagraphStyle);
                        $table->addCell(null)->addText('',$styleCenter, $myParagraphStyle);                       
                       
                    }
                    $phpWord = new TemplateProcessor(public_path('word/mau2.docx'));
                    $phpWord->setComplexBlock('{table}', $table);
                    $phpWord->setValues($dataFill);
                    $phpWord->saveAs('word/mau2_ex.docx');
                    return response()->json(['success'=>true,'url'=> '/word/mau2_ex.docx']);
                }
                else{
                    
                    return response()->json(['success'=>false]);
                }
            }
        }catch (Exception $e){
            return response()->json(['success'=>false]);
        }
    }
    public function exportMau3(Request $request){
        try {            
            $formData = $request->post();
            if(@$formData){
                $dataFill = [
                    'tenDonVi' => @$formData['tenDonVi'],
                    'tenKyThi'=> @$formData['tenKyThi'],
                    'tenPhongThi'=> @$formData['tenPhongThi'],     
                    'soLuong'=>1               
                ];
                $formData['danhSachThiSinh']=json_decode($formData['danhSachThiSinh']);
                if(@$formData['danhSachThiSinh'] && count((array)$formData['danhSachThiSinh'])){
                    $dataFill['soLuong']= count((array)$formData['danhSachThiSinh']);
                    $path = public_path('word/mau3.docx');
                    if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                    }
                    $table = new Table(array('borderSize' => 1, 'borderColor' => 'black', 'unit' => 'auto', 'width' =>  Converter::cmToTwip(16.5)));
                    $styleTitle = array('bold' => true, 'color' => 'black','alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ]);
                    $styleCenter = array('alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ]);
                    $myParagraphStyle = array('align'=>'center', 'spaceBefore'=>150, 'spaceafter' => 150);
                    $cellRowSpan = array('vMerge' => 'restart');
                    $cellRowContinue = array('vMerge' => 'continue');
                    $cellColSpan = array('gridSpan' => 3);
                    $table->addRow();
                    $table->addCell(Converter::cmToTwip(2), $cellRowSpan)->addText("STT",$styleTitle,$myParagraphStyle);
                    $table->addCell(Converter::cmToTwip(3), $cellRowSpan)->addText("SBD",$styleTitle,$myParagraphStyle);
                    $table->addCell(Converter::cmToTwip(4), $cellRowSpan)->addText("Họ và Tên",$styleTitle,$myParagraphStyle);
                    $table->addCell(Converter::cmToTwip(3), $cellRowSpan)->addText("Số tờ/số bài",$styleTitle,$myParagraphStyle);
                    $table->addCell(Converter::cmToTwip(5), $cellRowSpan)->addText("Ký Nộp",$styleTitle,$myParagraphStyle);
                    $table->addCell(Converter::cmToTwip(5), $cellRowSpan)->addText("Ghi Chú",$styleTitle,$myParagraphStyle);
                                
                    foreach ($formData['danhSachThiSinh'] as $index =>$detail) {                                       
                        $table->addRow();
                        $table->addCell(null)->addText($index + 1, $styleCenter, $myParagraphStyle);
                        $table->addCell(null)->addText(@$detail->maThiSinh,$styleCenter, $myParagraphStyle);
                        $table->addCell(null)->addText(@$detail->thi_sinh->tenThiSinh, $styleCenter, $myParagraphStyle);
                        $table->addCell(null)->addText('',$styleCenter, $myParagraphStyle);
                        $table->addCell(null)->addText('',$styleCenter, $myParagraphStyle);                       
                        $table->addCell(null)->addText('',$styleCenter, $myParagraphStyle);                       
                       
                    }
                    $phpWord = new TemplateProcessor(public_path('word/mau3.docx'));
                    $phpWord->setComplexBlock('{table}', $table);
                    $phpWord->setValues($dataFill);
                    $phpWord->saveAs('word/mau3_ex.docx');
                    return response()->json(['success'=>true,'url'=> '/word/mau3_ex.docx']);
                }
                else{
                    
                    return response()->json(['success'=>false]);
                }
            }
        }catch (Exception $e){
            return response()->json(['success'=>false]);
        }
    }
}