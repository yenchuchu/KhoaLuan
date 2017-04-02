<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'type', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function classes()
    {
        return $this->hasOne(\App\Classes::class, 'id');
    }

    public function roles()
    {
//        return $this->belongsToMany('App\Role');
        return $this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');
    }

//    public function assignRole($role)
//    {
//        return $this->roles()->save(
//            Role::whereCode($role)->firstOrFail()
//        );
//    }
//
//    public function detachRoles()
//    {
//        return $this->roles()->detach();
//    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('code', $role);
        }

        return !!$role->intersect($this->roles)->count();
    }

    public function user_skills()
    {
        return $this->hasMany(UserSkill::class, 'user_id');
    }

}
