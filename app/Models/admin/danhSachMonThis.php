<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhSachMonThis extends Model
{
    use HasFactory;
    protected $table = 'danhSachMonThis';
    protected $fillable = [
        'maMonHoc',
        'tenMonHoc',
        'hinhThucThi',
        'thongTinChiTiet',
        'ghiChu',
    ];
}
