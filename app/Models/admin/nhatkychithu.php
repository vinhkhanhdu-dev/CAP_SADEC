<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhatkychithu extends Model
{
    use HasFactory;
    protected $table = 'nhatkychithu';
    protected $fillable = [
        'code',
        'tencongviec',
        'sotienchi',
        'sotienthu',
        'chenhlech'
    ];
}