<?php

namespace Modules\User\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\User\Entities\Permission;
use Modules\User\Entities\Role;

class PermissionServiceProvider extends ServiceProvider
{
   
    /**
     * Checks that the user has the necessary permission.
     *
     * @return boolean
     */
    public function boot()
    {
        $user = auth()->user();
        $permissions = Permission::all();

        foreach($user->roles as $role)
            foreach ($permissions as $permission) {
                Gate::define($permission->name, function () use ($permission, $role) {
                    if ($role->permissions->contains('name', $permission->name)) {
                       return true;
                    }
                       return false;
                });
            }
    }
}
