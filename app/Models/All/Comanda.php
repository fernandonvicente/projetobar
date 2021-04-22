<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    protected $table = 'comanda';

    protected $fillable = ['user_id', 'cliente_id', 'recebimento_tipo_id', 'valor_total', 'comanda_status','despesa_tipo_id', 'sub_total', 'troco', 'valor_recebido'];
}
