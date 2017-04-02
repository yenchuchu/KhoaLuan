<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MultipleChoiceDetail extends Model
{
    use Notifiable;

    protected $table = 'multiple_choice_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'content', 'content_json', 'answer', 'multiple_choice_id'
    ];

    public function multiple_choice_detail() {
        return $this->belongsTo(MultipleChoice::class);
    }
}
