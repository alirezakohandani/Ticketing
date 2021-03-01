<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\Permission;
use Modules\User\Entities\Role;

class PermissionToRoleTableSeeder extends Seeder
{
    /**
     * Assign permissions to role
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();
        $permissions = Permission::all()->toArray();

        foreach($roles as $role)
        {
            if ($role->role == 'user') {
                continue;
            } 
            for ($i=0; $i<rand(1, 4); $i++) { 
                $role->permissions()->attach($permissions[$i]['id']);
            } 
        }
    }
}
