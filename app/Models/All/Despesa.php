<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    protected $table = 'despesa';

    protected $fillable = ['user_id', 'descricao', 'valor','arquivo','status'];
}
