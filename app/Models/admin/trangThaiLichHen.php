<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trangThaiLichHen extends Model
{
    use HasFactory;
    protected $table = 'create_table_trang_thai_lich_hen';
    protected $fillable = [
        'maTrangThai',
        'tenTrangThai',
        'ghiChu'
    ];
}