<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class khoiThis extends Model
{
    use HasFactory;
    protected $table = 'khoiThis';
    protected $fillable = [
        'maKhoiThi',
        'tenKhoiThi',
        'thongTinChiTiet',
        'ghiChu',
    ];
}
