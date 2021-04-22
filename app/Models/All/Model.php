<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;

class TextModel extends Model
{
    //protected $table = '';

    protected $fillable = ['client_id','name','text','status'];

    public function client()
	{
		return $this->belongsTo('App\Models\All\Client');
	}
	
    
}
