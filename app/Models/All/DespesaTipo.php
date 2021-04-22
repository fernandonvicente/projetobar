<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;

class DespesaTipo extends Model
{
    protected $table = 'despesa_tipo';

    protected $fillable = ['nome'];
    
}
