<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Skill extends Model
{
    use Notifiable;

    protected $table = 'skills';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'code',
    ];

    public function answer_questions()
    {
        return $this->belongsTo(AnswerQuestion::class);
    }

}
