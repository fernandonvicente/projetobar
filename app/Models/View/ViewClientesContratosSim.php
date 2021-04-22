<?php

namespace App\Models\View;

use Illuminate\Database\Eloquent\Model;

class ViewClientesContratosSim extends Model
{
	protected $table = 'view_clientes_contratos_s';
	
    protected $fillable = [
        'id', 'tipo_pessoa', 'documento', 'nome', 'email', 'status', 'data_cadastro', 'nome_consultor', 'cidade', 'uf', 'telefone', 'celular', 'servico_contratado'
    ];
}