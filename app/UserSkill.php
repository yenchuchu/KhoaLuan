<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserSkill extends Model
{
    use Notifiable;

    protected $table = 'user_skills';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'skill_json', 'test_id', 'level_id'
    ];

    public function answer_questions()
    {
        return $this->belongsTo(AnswerQuestion::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

//    public function skills() {
//        return $this->belongsToMany(Skill::class, 'skills');
//    }
}
