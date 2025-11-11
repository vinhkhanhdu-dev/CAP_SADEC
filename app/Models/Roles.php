<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $fillable = [        
        'code',
        'name',
        'id_parent',     
        'ListAction',
        'ListModule'       
    ];

    public function child()
    {
        return $this->hasMany(Roles::class, 'id_parent');
    }

    // Recursive children
    public function children()
    {
        return $this->hasMany(Roles::class, 'id_parent')
            ->with('children');
    }

    // One level parent
    public function parent()
    {
        return $this->belongsTo(Roles::class, 'id_parent');
    }

    // Recursive parents
    public function parents() {
        return $this->belongsTo(Roles::class, 'id_parent')
            ->with('parent');
    }    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function products(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Roles::class, 'id_category', 'id');
    }
}
