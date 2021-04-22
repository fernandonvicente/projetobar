<?php

namespace App\Models\View;

use Illuminate\Database\Eloquent\Model;

class ViewUser extends Model
{
	protected $table = 'view_users';
	
    protected $fillable = [
        'name', 'email', 'file', 'avatar', 'status', 'role_id', 'role_name',
    ];
}