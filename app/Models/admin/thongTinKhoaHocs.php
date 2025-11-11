<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thongTinKhoaHocs extends Model
{
    use HasFactory;
    protected $table = 'thongTinKhoaHocs';
    protected $fillable = [
        'maKhoaHoc',
        'tenKhoaHoc',
        'tenKhoaHocEN',
        'chiTietKhoaHoc',
        'thoiGianDaoTao',
        'tuNgay',
        'denNgay',
        'noiDaoTao',       
        'noiDaoTaoEN'       
    ];
}
