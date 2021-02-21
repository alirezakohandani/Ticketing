<?php

namespace Modules\User\Entities;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

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
    
     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    protected static function newFactory()
    {
        return \Modules\User\Database\factories\UserFactory::new();
    }
}