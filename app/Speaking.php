<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'content', 'type_user'
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

    public static function getRecordByUserId($user_id) {
        $ans_questions_all = Speaking::where(['type_user' => 'ST', 'user_id' => $user_id])->with('skills', 'levels')
            ->orderBy('type_code', 'desc')
            ->get();

        return $ans_questions_all;
    }
}
