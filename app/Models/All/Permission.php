<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'menu_id','name','label','session',
    ];


    public function roles(){
        return $this->belongsToMany('App\Models\All\Role');
    }
}
