<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kyThis extends Model
{
    use HasFactory;
    protected $table = 'kyThis';
    protected $fillable = [
        'maKyThi',
        'tenKyThi',
        'thongTinChiTiet',
        'ghiChu',
    ];
}
