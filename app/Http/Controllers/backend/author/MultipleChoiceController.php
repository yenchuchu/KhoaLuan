<?php

namespace App\Http\Controllers\backend\author;

use App\AnswerQuestion;
use App\BookMap;
use App\Classes;
use App\ExamType;
use App\Http\Controllers\Controller;
use App\Level;
use App\MultipleChoice;
use App\MultipleChoiceDetail;
use App\Skill;
use App\User;
use Illuminate\Http\Request;
use Route;
use Config;

class MultipleChoiceController extends Controller
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

        return view('backend.author.multiple_choice.index',
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

            return view('backend.author.multiple_choice.create',
                    compact('levels', 'class_code', 'code_user', 'classes', 'exam_types', 'book_maps'));
        }

        return view('backend.author.multiple_choice.create', compact('levels', 'class_code', 'code_user', 'classes'));
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

        foreach ($all_data['multiple_choice'] as $data) {

            $multiple_choice_content_question = $data['content-choose-ans-question'];
            foreach ($multiple_choice_content_question as $key_m => $mul) {
                $ans = $mul['answer'];
                $multiple_choice_content_question[$key_m]['answer'] = $mul['suggest_choose'][$ans];
            }
//            dd($multiple_choice_content_question);
            $multiple_choice = new MultipleChoice();

            $multiple_choice->title = $data['title-multiple-choice'];
//            $multiple_choice->content = $data['content-multiple-choice'];
//            $multiple_choice->point = $data['point'];
            $multiple_choice->type_user = $code_user;
            $multiple_choice->content_json = json_encode($multiple_choice_content_question);
            $multiple_choice->skill_id = $skill->id;
            $multiple_choice->exam_type_id = $exam_type_id;
            $multiple_choice->level_id = $level_id;
            $multiple_choice->class_id = $class_id;
//            $multiple_choice->bookmap_json_id = json_encode($book_map_id);
            $multiple_choice->bookmap_id = $book_map_id;

            $multiple_choice->save();

//            foreach ($multiple_choice_content_question as $detail) {
//                $multiple_choice_details = new MultipleChoiceDetail();
//
//                $multiple_choice_details->content = $detail['content'];
//                $multiple_choice_details->answer = $detail['answer'];
//                $multiple_choice_details->multiple_choice_id = $multiple_choice->id;
//
//                $detail_json = $detail['option-answer'];
//                $multiple_choice_details->content_json = json_encode($detail_json);
//
//                $multiple_choice_details->save();
//            }
        }

        return Redirect()->route('backend.manager.author.multiple-choice', $classes->code);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user_id = $request->all();
        $user = User::whereId($user_id)->with('roles')->first();

        if (count($user) != 1) {
            return response()->json([
                    'code' => 404,
                    'message' => 'Không tìm thấy người dùng!',
            ]);
        }
        $roles = $user->roles()->get();

        if (!isset($roles)) {
            return response()->json([
                    'code' => 404,
                    'message' => 'Không thực hiện được hành động này!',
            ]);
        }

        $roles_ids = [];
        foreach ($roles as $rol) {
            $roles_ids[] = $rol->id;
        }

        $user->roles()->detach($roles_ids);
        $user->delete();

        $users = User::with('roles', 'classes')->get();
        return view('backend.users.table-index', compact('users'));

    }
}
