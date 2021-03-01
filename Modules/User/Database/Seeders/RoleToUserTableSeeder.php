<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;

class RoleToUserTableSeeder extends Seeder
{
    /**
     * Assign role to user
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $roles = Role::all()->toArray();
        foreach($users as $user)
        {
            $user->roles()->attach($roles[array_rand($roles)]['id']);
        }
    }
}
