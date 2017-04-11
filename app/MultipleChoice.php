<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MultipleChoice extends Model
{
    use Notifiable;

    protected $table = 'multiple_choices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'point','content_json', 'type_user', 'created_at', 'updated_at'
    ];

    public function skills() {
        return $this->hasMany(Skill::class, 'id', 'skill_id' );
    }

    public function exam_types() {
        return $this->hasMany(ExamType::class, 'id', 'exam_type_id' );
    }

    public function classes() {
        return $this->hasMany(Classes::class, 'id', 'class_id' );
    }

    public function levels() {
        return $this->hasMany(Level::class, 'id', 'level_id');
    }

    public function multiple_choice_detail() {
        return $this->hasMany(MultipleChoiceDetail::class, 'id', 'multiple_choice_id');
    }

    public static function getRecordByUserId($user_id) {
        $ans_questions_all = MultipleChoice::where(['type_user' => 'ST', 'user_id' => $user_id])->with('skills', 'levels')
            ->orderBy('type_code', 'desc')
            ->get();

        return $ans_questions_all;
    }
}
