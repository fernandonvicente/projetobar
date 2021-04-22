<?php

namespace App\Models\View;

use Illuminate\Database\Eloquent\Model;

class ViewClientes extends Model
{
	protected $table = 'view_clientes';
	
    protected $fillable = [
        'id', 'nome', 'cidade', 'uf', 'status_cliente', 'codRW'
    ];
}