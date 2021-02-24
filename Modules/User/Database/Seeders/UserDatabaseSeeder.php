<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use Modules\User\Entities\Role;

class UserDatabaseSeeder extends Seeder
{
    /**
     * User variable
     *
     * @var User
     */
    private $user;

    /**
     * Role variable
     *
     * @var Role
     */
    private $role;

    /**
     * Create a new UserDatabaseSeeder.
     *
     * @param User $user
     * @param Role $role
     */
    public function __construct(User $user,Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = $this->user->createSuperAdminUser();
        $role = $this->role->createSuperAdminRole();
        $user->roles()->attach($role);
    }
    
}
