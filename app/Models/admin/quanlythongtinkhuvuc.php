<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quanlythongtinkhuvuc extends Model
{
    use HasFactory;
    protected $table = 'quanlythongtinkhuvuc';
    protected $fillable = [
        'maKhuVuc',
        'tenKhuVuc',
        'ghiChu',
        'maKhuVucCha'
    ];
}