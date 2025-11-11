<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thongTinDonVis extends Model
{
    use HasFactory;
    protected $table = 'thongTinDonVis';
    protected $fillable = [
        'maDonVi',
        'tenDonVi',
        'thongTinChiTiet',
        'ghiChu',
    ];
}
