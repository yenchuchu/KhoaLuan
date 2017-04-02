<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AnswerQuestionDetail extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'point', 'answer_question_id', 'content_json', 'answer'
    ];

    public function answer_questions()
    {
        return $this->belongsTo(AnswerQuestion::class);
    }
}
