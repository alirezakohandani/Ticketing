<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    /**
     * the roles that belong to the permission
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\User\Database\factories\PermissionFactory::new();
    }
}
