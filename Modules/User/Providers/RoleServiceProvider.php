<?php

namespace Modules\User\Providers;

use Illuminate\Auth\Access\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\User\Entities\Role;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        $roles = Role::all();
        foreach ($roles as $key => $role) {
            Gate::define($role->role, function($user) use($role) {
                return $user->roles->contains('role', $role->role );
            });
        }
    }
}
