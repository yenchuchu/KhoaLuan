<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Permission extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code'
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'permission_roles', 'permission_id', 'role_id');
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
}
