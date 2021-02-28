<?php

namespace Modules\User\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\User\Entities\Role;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Checks that the user has the necessary roles.
     *
     * @return boolean
     */
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
