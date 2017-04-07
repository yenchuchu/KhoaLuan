<?php

namespace App\Http\Controllers\backend\author;

use App\AnswerQuestion;
use App\BookMap;
use App\Classes;
use App\ExamType;
use App\Http\Controllers\Controller;
use App\Level;
use App\Skill;
use App\TickCircleTrueFalse;
use App\User;
use Illuminate\Http\Request;
use Route;
use Config;

class TickCircleTrueFalseController extends Controller
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
        $ans_questions_all = AnswerQuestion::where(['type_user' => 'ST'])->with('skills', 'levels')
            ->orderBy('type_code', 'desc')
            ->get();

        $type_codes = $ans_questions_all->groupBy('type_code');

        $array_id_intypecode = [];
        foreach ($type_codes as $code=> $item) {
            $array_id_intypecode[$code]['id'] = json_encode($item->pluck('id')->toArray());
            $array_id_intypecode[$code]['class_id'] = $item->pluck('class_id')->toArray();
            $array_id_intypecode[$code]['level_id'] = $item->pluck('level_id')->toArray();
            $array_id_intypecode[$code]['status'] = $item->pluck('status')->toArray();
            $array_id_intypecode[$code]['created_at'] = $item->pluck('created_at')->toArray();
        }

        $class_code = $this->url_parameters['class_code'];
        if ($class_code == 1) {
            $name_code = 'Elementary';
        } elseif ($class_code == 2) {
            $name_code = 'Secondary';
        } elseif ($class_code == 3) {
            $name_code = 'High School ';
        }

        return view('backend.author.tick-circle-true-false.index',
            compact('ans_for_students', 'ans_for_teachers', 'class_code', 'name_code', 'array_id_intypecode'));
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

            return view('backend.author.tick-circle-true-false.create',
                compact('levels', 'class_code', 'code_user', 'classes', 'exam_types', 'book_maps'));
        }

        return view('backend.author.tick-circle-true-false.create', compact('levels', 'class_code', 'code_user', 'classes'));
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

        foreach ($all_data['tick_true_false'] as $data) {

            $tick_true_false_content_question = $data['content-choose-ans-question'];
            $tick_true_false = new TickCircleTrueFalse();

            $tick_true_false->user_id = Auth::user()->id;
            $tick_true_false->title = $data['title-tick-true-false'];
            $tick_true_false->content = $data['content-tick-true-false'];
            $tick_true_false->point = $data['point'];
            $tick_true_false->type_user = $code_user;
            $tick_true_false->content_json = json_encode($tick_true_false_content_question);
            $tick_true_false->skill_id = $skill->id;
            $tick_true_false->exam_type_id = $exam_type_id;
            $tick_true_false->level_id = $level_id;
            $tick_true_false->class_id = $class_id;
//            $tick_true_false->bookmap_json_id = json_encode($book_map_id);
            $tick_true_false->bookmap_id = $book_map_id;

            $tick_true_false->save();
        }

        return Redirect()->route('backend.manager.author.tick-circle-true-false', $classes->code);
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
