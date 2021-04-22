<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
	protected $table = 'estados';

    protected $fillable = ['name', 'uf'];
	
    //public $timestamps = false;
    
    public function cities()
    {
        return $this->hasMany('App\Models\All\City');
    }
}
