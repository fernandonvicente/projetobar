<?php

namespace App\Models\View;

use Illuminate\Database\Eloquent\Model;

class ViewEquipamentos extends Model
{
	protected $table = 'view_equipamento';
	
    protected $fillable = [
        'equipamento_tipo', 'fabricante', 'modelo', 'numero_serie', 'mac_andress', 'status',
    ];
}