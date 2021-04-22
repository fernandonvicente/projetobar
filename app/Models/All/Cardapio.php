<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;

class Cardapio extends Model
{
    protected $table = 'cardapio';

    protected $fillable = ['user_id', 'produto', 'unidade', 'preco_venda', 'preco_promocao', 'status'];
}
