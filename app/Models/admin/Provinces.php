<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    use HasFactory;

    public function child()
    {
        return $this->hasMany(Provinces::class, 'ProvinceParent', 'ProvinceCode');
    }

    // Recursive children
    public function children()
    {
        return $this->hasMany(Provinces::class, 'ProvinceParent','ProvinceCode')
            ->with('children');
    }

    // One level parent
    public function parent()
    {
        return $this->belongsTo(Provinces::class, 'ProvinceParent','ProvinceCode');
    }

    // Recursive parents
    public function parents() {
        return $this->belongsTo(Provinces::class, 'ProvinceParent','ProvinceCode')
            ->with('parent');
    }
}
