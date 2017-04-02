<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Level extends Model
{
    use Notifiable;

    protected $table = 'levels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'code', 'point'
    ];

    public function answer_questions()
    {
        return $this->belongsTo(AnswerQuestion::class);
    }
}
