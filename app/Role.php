<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends Model
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

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_roles', 'role_id', 'user_id');

    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'permission_roles', 'role_id', 'permission_id');
    }
}
