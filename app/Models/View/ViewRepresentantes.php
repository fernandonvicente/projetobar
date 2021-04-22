<?php

namespace App\Models\View;

use Illuminate\Database\Eloquent\Model;

class ViewRepresentantes extends Model
{
	protected $table = 'view_representante';
	
    protected $fillable = [
        'id', 'nome', 'cidade', 'uf',
    ];
}