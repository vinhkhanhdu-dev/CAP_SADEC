<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Actions;
class Modules extends Model
{
    use HasFactory;

    protected $fillable = [        
        'code',
        'name',
        'id_parent',     
        'index',
        'alias',
        'class',
        'icon',
        'path',
        'type',
        'status'
    ];

    public function child()
    {
        return $this->hasMany(Modules::class, 'id_parent');
    }

    // Recursive children
    public function children()
    {
        return $this->hasMany(Modules::class, 'id_parent')
            ->with('children','action');
    }

    // One level parent
    public function parent()
    {
        return $this->belongsTo(Modules::class, 'id_parent');
    }

    // Recursive parents
    public function parents() {
        return $this->belongsTo(Modules::class, 'id_parent')
            ->with('parent');
    }    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function products(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Modules::class, 'id_category', 'id');
    }

    function action(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Actions::class, 'module_code', 'code');
    }
}
