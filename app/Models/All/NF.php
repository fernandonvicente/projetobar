<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;

class NF extends Model
{
    protected $table = 'nf';

    protected $fillable = ['despesa_id', 'user_id', 'arquivo'];
}
