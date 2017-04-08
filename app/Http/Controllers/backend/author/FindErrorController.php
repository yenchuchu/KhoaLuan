<?php

namespace App\Http\Controllers\backend\author;

use App\BookMap;
use App\Classes;
use App\ExamType;
use App\FindError;
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

class FindErrorController extends Controller
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
        $ans_questions_all = FindError::where(['type_user' => 'ST'])->with('skills', 'levels')
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

        return view('backend.author.find_errors.index',
            compact( 'class_code', 'name_code', 'array_id_intypecode'));

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

            return view('backend.author.find_errors.create',
                compact('levels', 'class_code', 'code_user', 'classes', 'exam_types', 'book_maps'));
        }

        return view('backend.author.find_errors.create', compact('levels', 'class_code', 'code_user', 'classes'));
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

        $type_code_next = User::get_typecode_next('find_errors');

        $user =  Auth::user();
        $user_auth_id = $user->id;

        $data_new = [];
        $new_id = [];
        $data_new['user_id'] = $user_auth_id;

        foreach ($all_data['find_errors'] as $data) {

            $find_error_content_question = $data['content-choose-ans-question'];
//            $array_suggest_ans ;
            foreach ($find_error_content_question as $key => $value) {

                $content_qts = $value['content'];

                preg_match_all("~<u\>(.*?)\<\/u\>~", $content_qts, $array_suggest_ans);
                $find_error_content_question[$key]['suggest_choose'] = $array_suggest_ans[1];
            }

            $find_error = new FindError();

            $find_error->user_id = Auth::user()->id;
            $find_error->title = $data['title-find-errors'];
            $find_error->type_user = $code_user;
            $find_error->content_json = json_encode($find_error_content_question);
            $find_error->skill_id = $skill->id;
            $find_error->exam_type_id = $exam_type_id;
            $find_error->level_id = $level_id;
            $find_error->class_id = $class_id;
            $find_error->bookmap_id = $book_map_id;
            $find_error->type_code = $type_code_next;

            $find_error->save();

            $new_id[] = $find_error->id;
            $data_new['created_at'] = $find_error->created_at;
            $data_new['url_avatar_user'] = $user->avatar;
        }

        $title_class = $classes->title;

        $level = Level::getLevelbyId($level_id);
        $level_title = $level->title;

        $data_new['user_id_receive'] = User::find_all_userId_by_code('AD');
        $data_new['url'] = route('backend.manager.author.get.detail', ['find_errors', $user_auth_id ,json_encode($new_id)]);
        $data_new['content'] = $user->user_name.' đã tạo câu hỏi cho phần Find Errors mức '.$level_title. ' cho ' . $title_class;

        Session::flash('message', 'Tạo thành công!');
        Session::flash('notification_new', $data_new);

        return Redirect()->route('backend.manager.author.find-errors', $classes->code);
    }

    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
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

        foreach ($all_data['find_errors'] as $key => $data) {
            $id_record = $data['id_record'];
            $read = FindError::where(['id' => $id_record])->first();

            $read_content_question = $data['content-choose-ans-question'];
//            $array_suggest_ans ;
            foreach ($read_content_question as $key => $value) {

                $content_qts = $value['content'];

                preg_match_all("~<u\>(.*?)\<\/u\>~", $content_qts, $array_suggest_ans);
                $read_content_question[$key]['suggest_choose'] = $array_suggest_ans[1];
            }

            $read->title = $data['title-find-errors'];
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
            $data_new['url'] = route('backend.manager.author.get.detail', ['find_errors' , $all_data['authorspost'], $json_encode_id]);
            $data_new['content'] = 'Bài viết về Find Error mức '. $level_title.  ' cho '. $title_class .' của bạn đã được chấp nhận ';

            Session::flash('notification_new', $data_new);

            $user = User::type_user();
            $user_author = $user['user_author'];
            $user_student = $user['user_student'];
            $user_admin = $user['user_admin'];

            $route = route('backend.manager.author.get.detail', ['find_errors' , $all_data['authorspost'], $json_encode_id]);
            return Redirect::to($route)
                ->with(['user_author' => $user_author,
                    'user_student' => $user_student,
                    'user_admin' => $user_admin]);

        } else {
            $ans_questions_all = FindError::where(['type_user' => 'ST'])->with('skills', 'levels')
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

            $class_find = Classes::getClassById($class_id);
            $class_code = $class_find->code;
            if ($class_code == 1) {
                $name_code = 'Elementary';
            } elseif ($class_code == 2) {
                $name_code = 'Secondary';
            } elseif ($class_code == 3) {
                $name_code = 'High School ';
            }

            return Redirect::to('backend/manager-author/find-errors/'.$class_code)
                ->with(['class_code' => $class_code,
                    'name_code' => $name_code,
                    'array_id_intypecode' => $array_id_intypecode]);
        }
    }

}
