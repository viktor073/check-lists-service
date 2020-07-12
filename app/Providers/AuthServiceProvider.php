<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        CheckList::class => CheckListPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();



        Blade::if('role', function (... $roles){
            foreach ($roles as $role){
               if (auth()->check() && auth()->user()->hasRole($role)) {
                   return true;
               }
            }
            return false;
        });

        Blade::if('permission', function (... $permissions){
            foreach ($permissions as $permission) {
               return auth()->check() && auth()->user()->hasPermissionTo($permission) || auth()->user()->hasRole('super-admin');
            }
        });

    }
}
