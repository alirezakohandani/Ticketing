<?php

namespace Modules\User\Providers;

use Illuminate\Support\Facades\Gate;
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

    public function boot()
    {
        $roles = Role::all();
        foreach ($roles as $role) {
            Gate::define($role->role, function ($user) use ($role) {
                return $user->roles->contains('role', $role->role );
            });
        }
    }
}
