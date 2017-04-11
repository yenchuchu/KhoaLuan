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
use Auth;
use Session;
use DB;
use Illuminate\Support\Facades\Redirect;

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
        $ans_questions_all = AnswerQuestion::getRecordByUserId(Auth::user()->id);

        $type_codes = $ans_questions_all->groupBy('type_code');

        $array_id_intypecode = [];
        foreach ($type_codes as $code=> $item) {
            $array_id_intypecode[$code]['id'] = json_encode($item->pluck('id')->toArray());
            $array_id_intypecode[$code]['class_id'] = $item->pluck('class_id')->toArray();
            $array_id_intypecode[$code]['level_id'] = $item->pluck('level_id')->toArray();
            $array_id_intypecode[$code]['status'] = $item->pluck('status')->toArray();
            $array_id_intypecode[$code]['created_at'] = $item->pluck('created_at')->toArray();
        }

//        $class_code = $this->url_parameters['class_code'];
//        if ($class_code == 1) {
//            $name_code = 'Elementary';
//        } elseif ($class_code == 2) {
//            $name_code = 'Secondary';
//        } elseif ($class_code == 3) {
//            $name_code = 'High School ';
//        }

        return view('backend.author.answer_question.index',
            compact('name_code', 'array_id_intypecode'));
    }

    public function create()
    {
        $levels = $this->levels;
        $classes = $this->classes;


//        $class_code = $this->url_parameters['class_code'];
        $code_user = $this->url_parameters['code_user'];

//        $classes = $all_classes->filter(function ($class) use ($class_code) {
//            return ($class->code == $class_code);
//        });

//        $classes = Classes::all();

        if ($code_user == 'TC') {
            $exam_types = ExamType::all();
            $book_maps = BookMap::all();

            return view('backend.author.answer_question.create',
                compact('levels', 'code_user', 'classes', 'exam_types', 'book_maps'));
        }

        return view('backend.author.answer_question.create', compact('levels', 'code_user', 'classes'));
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
        $classes = Classes::getClassById($class_id);

        $type_code_next = User::get_typecode_next('answer_questions');

        $user =  Auth::user();
        $user_auth_id = $user->id;

        $data_new = [];
        $new_id = [];
        $data_new['user_id'] = $user_auth_id;

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

            $new_id[] = $answer_question->id;
            $data_new['created_at'] = $answer_question->created_at;
            $data_new['url_avatar_user'] = $user->avatar;
        }

        $title_class = $classes->title;

        $level = Level::getLevelbyId($level_id);
        $level_title = $level->title;

        $data_new['user_id_receive'] = User::find_all_userId_by_code('AD');
        $data_new['url'] = route('backend.manager.author.get.detail', ['answer_questions', $user_auth_id ,json_encode($new_id)]);
        $data_new['content'] = $user->user_name.' đã tạo câu hỏi cho phần Answer Questions mức '.$level_title. ' cho ' . $title_class;

        Session::flash('message', 'Tạo thành công!');
        Session::flash('notification_new', $data_new);

        return Redirect()->route('backend.manager.author.answer-question', $classes->code);
    }

    public function update(Request $request) {
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
        $classes = Classes::getClassById($class_id);

        $user =  Auth::user();

        $data_new = [];
        $new_id = [];

        foreach ($all_data['answer_question'] as $key => $data) {
            $id_record = $data['id_record'];
            $read = AnswerQuestion::where(['id' => $id_record])->first();

            $read_content_question = $data['content-choose-ans-question'];

            $read->title = $data['title-answer-question'];
            $read->type_user = $code_user;
            $read->content_json = json_encode($read_content_question);
            $read->skill_id = $skill->id;
            $read->exam_type_id = $exam_type_id;
            $read->level_id = $level_id;
            $read->class_id = $class_id;
            $read->bookmap_id = $book_map_id;
            if (Auth::user()->hasRole('AD')) {
                $read->status = 1;
            } else {
                $read->status = 0;
            }

            $read->save();

            if (Auth::user()->hasRole('AD')) {
                $new_id[] = $read->id;
                $data_new['created_at'] = $read->created_at;
                $data_new['url_avatar_user'] = $user->avatar;
            }
        }

        Session::flash('message', 'Cập nhật thành công!');

        if (Auth::user()->hasRole('AD')) {
            $title_class = $classes->title;

            $level = Level::getLevelbyId($level_id);
            $level_title = $level->title;
            $json_encode_id = json_encode($new_id);

            $data_new['user_id_receive'] = ['0' => $all_data['authorspost']];
            $data_new['url'] = route('backend.manager.author.get.detail', ['answer_questions' , $all_data['authorspost'], $json_encode_id]);
            $data_new['content'] = 'Bài viết về Answer Question mức '. $level_title.  ' cho '. $title_class .' của bạn đã được chấp nhận ';

            Session::flash('notification_new', $data_new);

            $user = User::type_user();
            $user_author = $user['user_author'];
            $user_student = $user['user_student'];
            $user_admin = $user['user_admin'];

            $route = route('backend.manager.author.get.detail', ['answer_questions' , $all_data['authorspost'], $json_encode_id]);
            return Redirect::to($route)
                ->with(['user_author' => $user_author,
                    'user_student' => $user_student,
                    'user_admin' => $user_admin]);

        } else {
            $ans_questions_all = AnswerQuestion::where(['type_user' => 'ST'])->with('skills', 'levels')
                ->orderBy('type_code', 'desc')
                ->get();

            $type_codes = $ans_questions_all->groupBy('type_code');

            $array_id_intypecode = [];
            foreach ($type_codes as $code=> $item) {
                $array_id_intypecode[$code]['id'] = json_encode($item->pluck('id')->toArray());
                $array_id_intypecode[$code]['class_id'] = array_unique($item->pluck('class_id')->toArray());
                $array_id_intypecode[$code]['level_id'] = array_unique($item->pluck('level_id')->toArray());
                $array_id_intypecode[$code]['status'] = array_unique($item->pluck('status')->toArray());
                $array_id_intypecode[$code]['created_at'] = array_unique($item->pluck('created_at')->toArray());
            }

//            $class_find = Classes::getClassById($class_id);
//            $class_code = $class_find->code;
//            if ($class_code == 1) {
//                $name_code = 'Elementary';
//            } elseif ($class_code == 2) {
//                $name_code = 'Secondary';
//            } elseif ($class_code == 3) {
//                $name_code = 'High School ';
//            }

            return Redirect::to('backend/manager-author/answer-question')
                ->with(['array_id_intypecode' => $array_id_intypecode]);
        }
    }

}
