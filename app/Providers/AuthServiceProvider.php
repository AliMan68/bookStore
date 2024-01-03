<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach (Permission::all() as $permission){
            Gate::define($permission->title,function ($user) use($permission){
                if ($user->is_admin == 1)
                    return true;

                return $user->hasPermission($permission);
            });
        }
//        foreach (Role::all() as $role){
//            Gate::define($role->title,function ($user) use($role){
//                if ($user->is_admin == 1)
//                    return true;
//                return $user->hasRole($role);
//            });
//        }

//        Gate::define('manage-orders',function ($user){
//            //here we check if user has permission
//            return $user->id === $value->id;
//        });
    }
}
