<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class namHocs extends Model
{
    use HasFactory;
    protected $table = 'namHocs';
    protected $fillable = [
        'maNamHoc',
        'tenNamHoc',
        'ghiChu',
    ];
}
