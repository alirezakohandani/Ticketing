<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['role'];

    public $timestamps = false;

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

    /**
     * Create super admin role
     *
     * @return void
     */
    public function createSuperAdminRole()
    {
        return $this->create([
            'role' => 'super_admin',
        ]);
    }

    protected static function newFactory()
    {
        return \Modules\User\Database\factories\RoleFactory::new();
    }
}
