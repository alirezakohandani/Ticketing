<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password'];

    /**
     * The roles that belong to the user
     */
    public function roles()
    {
        return $this->BelongsToMany(Role::class);
    }

    /**
     * Assign role to users
     *
     * @param string $role
     * @return user
     */
    public function assignRolesToUsers(string $role)
    {
        $role = Role::where('role', $role)->get();
        $this->roles()->syncWithoutDetaching($role);
        return $this;
    }
    
    protected static function newFactory()
    {
        return \Modules\User\Database\factories\UserFactory::new();
    }
}