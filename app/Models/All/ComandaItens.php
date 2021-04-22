<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;

class ComandaItens extends Model
{
    protected $table = 'comanda_itens';

    protected $fillable = ['user_id', 'comanda_id', 'cardapio_id', 'valor', 'quantidade','status'];
}
