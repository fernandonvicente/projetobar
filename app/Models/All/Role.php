<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $fillable = [
        'name','label',
    ];

    public function permissions(){        
         return $this->belongsToMany('App\Models\All\Permission');
    }
}
