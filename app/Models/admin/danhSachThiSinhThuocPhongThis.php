<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhSachThiSinhThuocPhongThis extends Model
{
    use HasFactory;
    protected $table = 'danhSachThiSinhThuocPhongThis';
    protected $fillable = [       
        'maThiSinh',
        'ketQua',
        'maKhoiThi',
        'maKyThi',
        'maNamHoc',
        'maPhongThi',
        'maMonHoc',
        'maDonVi',
        'ghiChu',        
    ];
    public function namHoc(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(namHocs::class, 'maNamHoc', 'maNamHoc');
    }
    public function khoiThi(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(khoiThis::class, 'maKhoiThi', 'maKhoiThi');
    }
    public function thiSinh(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(danhSachThiSinhs::class, 'maThiSinh', 'maThiSinh');
    }
    public function kyThi(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(kyThis::class, 'maKyThi', 'maKyThi');
    }
    public function phongThi(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(danhSachPhongThis::class, 'maPhongThi', 'maPhongThi');
    }
    public function monHoc(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(danhSachMonThis::class, 'maMonHoc', 'maMonHoc');
    }
    public function donVi(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(thongTinDonVis::class, 'maDonVi', 'maDonVi');
    }
}
