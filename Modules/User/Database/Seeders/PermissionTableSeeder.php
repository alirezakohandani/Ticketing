<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionName = [
            'see tickets'      => 'مشاهده تیکت ها', 
            'see users'        => 'مشاهده کاربران',
            'response tickets' => 'پاسخ به تیکت ها', 
            'close tickets'    => 'بستن تیکت ها'
        ];

        foreach($permissionName as $name => $pName)
        {
            Permission::create([
                'name' => $name,
                'p_name' => $pName,
            ]);     
        }
    }
}
