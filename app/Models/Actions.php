<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actions extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [        
        'code',
        'name',
        'module_code',     
        'type'
    ];

    public function child()
    {
        return $this->hasMany(Modules::class, 'id_module');
    }

    // Recursive children
    public function children()
    {
        return $this->hasMany(Modules::class, 'id_module')
            ->with('children');
    }

    // One level parent
    public function parent()
    {
        return $this->belongsTo(Modules::class, 'id_module');
    }

    // Recursive parents
    public function parents() {
        return $this->belongsTo(Modules::class, 'id_module')
            ->with('parent');
    }    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function products(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Modules::class, 'id_module', 'code');
    }
}
