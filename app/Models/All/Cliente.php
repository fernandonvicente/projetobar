<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{

	use Notifiable;

	protected $guard = 'area-cliente';

    protected $table = 'cliente';

    protected $fillable = ['documento', 'nome', 'email', 'celular', 'arquivo','status','password'];

    protected $hidden = [
        'password', 'remember_token', 
    ];
}
