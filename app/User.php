<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'type', 'email'
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

    public static function type_user()
    {
        $users = User::with('roles', 'classes')->get();

        $user_author = $users->filter(function ($user) {
            return $user->type == Role::getRoleByCode('AT')->id;
        })->all();

        $user_student = $users->filter(function ($user) {
            return $user->type == Role::getRoleByCode('ST')->id;
        })->all();

        $user_admin = $users->filter(function ($user) {
            return $user->type == Role::getRoleByCode('AD')->id;
        })->all();

        return ['user_author' => $user_author, 'user_student' => $user_student, 'user_admin' => $user_admin];
    }

    // mỗi lần add -> tạo 1 code.
    public static function get_typecode_next($name_table) {
        $type_code = DB::table($name_table)->max('type_code');

        $type_next = $type_code + 1;

        return $type_next;
    }

    public static function find_all_userId_by_code($code_user) {
        $role = Role::where(['code' => $code_user])->first();
        $users = User::where('type', $role->id)->get();
        $user_ids = $users->pluck('id')->toArray();

        return $user_ids;
    }

}
