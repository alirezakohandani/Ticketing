<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['role'];

    /**
     * The users that belong to the role
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * the permissions that belong to the role
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Assign permission to roles
     *
     * @param string $pormission
     * @return role
     */
    public function assignPermissionToRoles(string $permission)
    {
        $permission = Permission::where('name', $permission)->get();
        $this->permissions()->syncWithoutDetaching($permission);
        return $this;
    }

    protected static function newFactory()
    {
        return \Modules\User\Database\factories\RoleFactory::new();
    }
}
