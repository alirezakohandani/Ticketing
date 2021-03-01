<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleName = [
            'user'   => 'کاربر', 
            'admin1' => 'مدیر سطح ۱', 
            'admin2' => 'مدیر سطح ۲'
        ];

        foreach($roleName as $role => $pRole)
        {
            Role::create([
                'role' => $role,
                'p_role' => $pRole,
            ]);     
        }
    }
}
