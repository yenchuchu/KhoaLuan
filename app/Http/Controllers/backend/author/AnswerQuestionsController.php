<?php

namespace App\Http\Controllers\backend\author;

use App\AnswerQuestion;
use App\BookMap;
use App\Classes;
use App\ExamType;
use App\Http\Controllers\Controller;
use App\Level;
use App\Skill;
use App\User;
use Illuminate\Http\Request;
use Route;
use Config;

class AnswerQuestionsController extends Controller
{
    protected $levels;
    protected $skill;
    protected $classes;

    /**
     * @var $type_diff = 1 : tao de cho giao vien
     * = 2: tao de cho hoc sinh
     */
    protected $type_diff;
    protected $class_code;
    protected $code_user;

    public function __construct()
    {
        $this->levels = Level::all();
        $this->classes = Classes::all();
        $this->skill = 'Read';

        $this->url_parameters = Route::getCurrentRoute()->parameters();
    }

    public function index()
    {
        $ans_questions_all = AnswerQuestion::orderBy('level_id', 'ASC')
            ->with('skills', 'levels')
            ->get();

        $for_teachers = $ans_questions_all->filter(function ($ans) {
            return ($ans->type_user == 'TC');
        });

        $for_students = $ans_questions_all->filter(function ($ans) {
            return ($ans->type_user == 'ST');
        });

        $ans_for_students = [];
        foreach ($for_students as $ans) {
            $ans->content_json = json_decode($ans->content_json);
            $ans->skills = $ans->skills->first();
            $ans->levels = $ans->levels->first();

            $ans_for_students[] = $ans;
        }

        $ans_for_teachers = [];
        foreach ($for_teachers as $ans) {
            $ans->content_json = json_decode($ans->content_json);
            $ans->skills = $ans->skills->first();

            $ans_for_teachers[] = $ans;
        }

        $class_code = $this->url_parameters['class_code'];
        if ($class_code == 1) {
            $name_code = 'Elementary';
        } elseif ($class_code == 2) {
            $name_code = 'Secondary';
        } elseif ($class_code == 3) {
            $name_code = 'High School ';
        }

        return view('backend.author.answer_question.index',
            compact('ans_for_students', 'ans_for_teachers', 'class_code', 'name_code'));
    }

    public function create()
    {
        $levels = $this->levels;
        $all_classes = $this->classes;


        $class_code = $this->url_parameters['class_code'];
        $code_user = $this->url_parameters['code_user'];

        $classes = $all_classes->filter(function ($class) use ($class_code) {
            return ($class->code == $class_code);
        });

        if ($code_user == 'TC') {
            $exam_types = ExamType::all();
            $book_maps = BookMap::all();

            return view('backend.author.answer_question.create',
                compact('levels', 'class_code', 'code_user', 'classes', 'exam_types', 'book_maps'));
        }

        return view('backend.author.answer_question.create', compact('levels', 'class_code', 'code_user', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all_data = $request->all();

        if (!isset($all_data['level_id'])) {
            $all_data['level_id'] = null;
        }

        if (!isset($all_data['book_map_id'])) {
            $all_data['book_map_id'] = null;
        }

        if (!isset($all_data['exam_type_id'])) {
            $all_data['exam_type_id'] = null;
        }

        $skill = Skill::where('code', $this->skill)->first();
        $level_id = $all_data['level_id'];
        $code_user = $all_data['code_user'];
        $book_map_id = $all_data['book_map_id'];
        $exam_type_id = $all_data['exam_type_id'];

        $class_id = $all_data['class_id'];
        $classes = Classes::whereId($class_id)->first();

        $type_code_next = get_typecode_next('answer_questions');

        foreach ($all_data['answer_question'] as $data) {

            $answer_question_content_question = $data['content-choose-ans-question'];
            $answer_question = new AnswerQuestion();

            $answer_question->title = $data['title-answer-question'];
            $answer_question->content = $data['content-answer-question'];
            $answer_question->user_id = Auth::user()->id;
            $answer_question->type_user = $code_user;
            $answer_question->content_json = json_encode($answer_question_content_question);
            $answer_question->skill_id = $skill->id;
            $answer_question->exam_type_id = $exam_type_id;
            $answer_question->level_id = $level_id;
            $answer_question->class_id = $class_id;
            $answer_question->bookmap_id = $book_map_id;
            $answer_question->type_code = $type_code_next;

            $answer_question->save();
        }

        return Redirect()->route('backend.manager.author.answer-question', $classes->code);
    }

    // mỗi lần add -> tạo 1 code.
    public function get_typecode_next($name_table) {
        $type_code = DB::table($name_table)->max('type_code');

        $type_next = $type_code + 1;

        return $type_code;
    }


}
