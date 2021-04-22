<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

	protected $table = 'cidades';

    protected $fillable = ['name', 'state_id'];

    public function state()
	{
		return $this->belongsTo('App\Models\All\State');
	}
}
