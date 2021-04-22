<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;

class DespesaItem extends Model
{
    protected $table = 'despesa_itens';

    protected $fillable = ['user_id', 'despesa_id', 'valor', 'quantidade','despesa_tipo_id','cardapio_id','status'];
}
