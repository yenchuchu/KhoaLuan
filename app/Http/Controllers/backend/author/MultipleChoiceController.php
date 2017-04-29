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
use Auth;
use Session;
use DB;
use Illuminate\Support\Facades\Redirect;

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
        $ans_questions_all = MultipleChoice::getRecordByUserId(Auth::user()->id);

        $type_codes = $ans_questions_all->groupBy('type_code');

        $array_id_intypecode = [];
        foreach ($type_codes as $code=> $item) {
            $array_id_intypecode[$code]['id'] = json_encode($item->pluck('id')->toArray());
            $array_id_intypecode[$code]['class_id'] = $item->pluck('class_id')->toArray();
            $array_id_intypecode[$code]['level_id'] = $item->pluck('level_id')->toArray();
            $array_id_intypecode[$code]['status'] = $item->pluck('status')->toArray();
            $array_id_intypecode[$code]['created_at'] = $item->pluck('created_at')->toArray();
        }

        return view('backend.author.multiple_choice.index',
            compact( 'class_code', 'name_code', 'array_id_intypecode'));
    }

    public function create()
    {
        $levels = $this->levels;
        $classes = $this->classes;

        $code_user = $this->url_parameters['code_user'];

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
        $classes = Classes::getClassById($class_id);

        $type_code_next = User::get_typecode_next('multiple_choices');

        $user =  Auth::user();
        $user_auth_id = $user->id;

        $data_new = [];
        $new_id = [];
        $data_new['user_id'] = $user_auth_id;

        foreach ($all_data['multiple_choice'] as $data) {

            $multiple_choice_content_question = $data['content-choose-ans-question'];
            foreach ($multiple_choice_content_question as $key_m => $mul) {
                $ans = $mul['answer'];
                $multiple_choice_content_question[$key_m]['answer'] = $mul['suggest_choose'][$ans];
            }

            if (!isset($data['content-multiple-choice'])) {
                $data['content-multiple-choice'] = null;
            }
//            dd($multiple_choice_content_question);
            $multiple_choice = new MultipleChoice();

            $multiple_choice->title = $data['title-multiple-choice'];
            $multiple_choice->content = $data['content-multiple-choice'];
//            $multiple_choice->point = $data['point'];
            $multiple_choice->user_id = Auth::user()->id;
            $multiple_choice->type_user = $code_user;
            $multiple_choice->content_json = json_encode($multiple_choice_content_question);
            $multiple_choice->skill_id = $skill->id;
            $multiple_choice->exam_type_id = $exam_type_id;
            $multiple_choice->level_id = $level_id;
            $multiple_choice->class_id = $class_id;
            $multiple_choice->bookmap_id = $book_map_id;
            $multiple_choice->type_code = $type_code_next;

            $multiple_choice->save();

            $new_id[] = $multiple_choice->id;
            $data_new['created_at'] = $multiple_choice->created_at;
            $data_new['url_avatar_user'] = $user->avatar;
        }


        $title_class = $classes->title;

        $level = Level::getLevelbyId($level_id);
        $level_title = $level->title;

        $data_new['user_id_receive'] = User::find_all_userId_by_code('AD');
        $data_new['url'] = route('backend.manager.author.get.detail', ['multiple_choices', $user_auth_id ,json_encode($new_id)]);
        $data_new['content'] = $user->user_name.' đã tạo câu hỏi cho phần Multiple Choices mức '.$level_title. ' cho ' . $title_class;

        Session::flash('message', 'Tạo thành công!');
        Session::flash('notification_new', $data_new);

        return Redirect()->route('backend.manager.author.multiple-choice', $classes->code);
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
//        dd($all_data);

        foreach ($all_data['multiple_choice'] as $key => $data) {
            $multiple_choice_content_question = $data['content-choose-ans-question'];

            if (!isset($data['content-multiple-choice'])) {
                $data['content-multiple-choice'] = null;
            }

            foreach ($multiple_choice_content_question as $key_m => $mul) {
                $ans = $mul['answer'];
                $multiple_choice_content_question[$key_m]['answer'] = $mul['suggest_choose'][$ans];
            }

            $id_record = $data['id_record'];
            $read = MultipleChoice::where(['id' => $id_record])->first();

            $read_content_question = $data['content-choose-ans-question'];

            $read->title = $data['title-multiple-choice'];
            $read->type_user = $code_user;
            $read->content_json = json_encode($multiple_choice_content_question);
            $read->content = $data['content-multiple-choice'];
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
            $data_new['url'] = route('backend.manager.author.get.detail', ['multiple_choices' , $all_data['authorspost'], $json_encode_id]);
            $data_new['content'] = 'Bài viết về Multiple Choices mức '. $level_title.  ' cho '. $title_class .' của bạn đã được chấp nhận ';

            Session::flash('notification_new', $data_new);

            $user = User::type_user();
            $user_author = $user['user_author'];
            $user_student = $user['user_student'];
            $user_admin = $user['user_admin'];

            $route = route('backend.manager.author.get.detail', ['multiple_choices' , $all_data['authorspost'], $json_encode_id]);
            return Redirect::to($route)
                ->with(['user_author' => $user_author,
                    'user_student' => $user_student,
                    'user_admin' => $user_admin]);

        } else {
            $ans_questions_all = MultipleChoice::where(['type_user' => 'ST'])->with('skills', 'levels')
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

            return Redirect::to('backend/manager-author/multiple-choice')
                ->with(['array_id_intypecode' => $array_id_intypecode]);
        }
    }
}
