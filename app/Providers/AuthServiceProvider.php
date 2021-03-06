<?php

namespace App\Providers;

#use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\All\Permission;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);


        //pegando todas as permissões
        $permissions = Permission::with('roles')->get();

        foreach ($permissions as $permission) {
            $gate->define($permission->name, function(User $user) use ($permission) {

                return $user->hasPermission($permission);

            });
        }

        //before escapa da permissão setado, liberando todas permissões para admin
        $gate->before(function(User $user, $ability){

            if($user->hasAnyRole('Admin'))
                return true;

        });
    }
}
