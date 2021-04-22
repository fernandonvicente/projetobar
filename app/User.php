<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\All\Permission;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status','file','avatar','representante_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 
    ];

    public function userType(){
        //relacionamento muitos para 1
        return $this->belongsTo('App\Models\Admin\Usertype');
    }


    public function roles(){        
         return $this->belongsToMany('App\Models\All\Role');
    }

    public function hasPermission(Permission $permission){        
        return $this->hasAnyRole($permission->roles);
    }

    public function hasAnyRole($roles){        
        
        if(is_array($roles) || is_object($roles)){
            
               return !! $roles->intersect($this->roles)->count();
           
        }

        return $this->roles->contains('name',$roles);
    }

}

