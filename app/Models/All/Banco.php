<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table = 'bancos';

    protected $fillable = ['cod', 'banco'];
    
}
