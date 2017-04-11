<?php

namespace App\Http\Controllers\backend\author;

use App\BookMap;
use App\Classes;
use App\ExamType;
use App\Http\Controllers\Controller;
use App\Level;
use App\ListenTableTicks;
use App\Role;
use App\Skill;
use App\User;
use Illuminate\Http\Request;
use Route;
use Config;
use DB;
use Session;
use Auth;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ListenTableTicksController extends Controller
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
        $this->skill = 'Listen';

        $this->url_parameters = Route::getCurrentRoute()->parameters();
    }

    public function index()
    {
        $ans_questions_all = ListenTableTicks::getRecordByUserId(Auth::user()->id);

        $type_codes = $ans_questions_all->groupBy('type_code');

        $array_id_intypecode = [];
        foreach ($type_codes as $code=> $item) {
            $array_id_intypecode[$code]['id'] = json_encode($item->pluck('id')->toArray());
            $array_id_intypecode[$code]['class_id'] = array_unique($item->pluck('class_id')->toArray());
            $array_id_intypecode[$code]['level_id'] = array_unique($item->pluck('level_id')->toArray());
            $array_id_intypecode[$code]['status'] = array_unique($item->pluck('status')->toArray());
            $array_id_intypecode[$code]['created_at'] = array_unique($item->pluck('created_at')->toArray());
        }

//        $class_code = $this->url_parameters['class_code'];
//        if ($class_code == 1) {
//            $name_code = 'Elementary';
//        } elseif ($class_code == 2) {
//            $name_code = 'Secondary';
//        } elseif ($class_code == 3) {
//            $name_code = 'High School ';
//        }

        return view('backend.author.listen.table-tick.index',
            compact('class_code', 'name_code', 'array_id_intypecode'));
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

        if ($code_user == 'TC') {
            $exam_types = ExamType::all();
            $book_maps = BookMap::all();

            return view('backend.author.listen.listen-tick.create',
                compact('levels', 'class_code', 'code_user', 'classes', 'exam_types', 'book_maps'));
        }

        return view('backend.author.listen.table-tick.create', compact('levels', 'class_code', 'code_user', 'classes'));
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

        $type_code_next = User::get_typecode_next('listen_table_ticks');

        $user =  Auth::user();
        $user_auth_id = $user->id;

        $data_new = [];
        $new_id = [];
        $data_new['user_id'] = $user_auth_id;

        foreach ($all_data['listen_table_ticks'] as $key => $data) {
            $listen = new ListenTableTicks();

            $listen_content_question = $data['content-choose-ans-question'];

            $array_json = [];
            foreach ($listen_content_question as $idx => $item) {
                $array_json['suggest_choose'][] = $item['suggest'];

                if(isset($item['answer'])) {
                    $array_json['answer'][] = $item['suggest'];
                }
            }

            $listen->title = $data['title-listen-table-ticks'];
            $listen->user_id = $user_auth_id;
            $listen->type_user = $code_user;
            $listen->content_json = json_encode($array_json);
            $listen->skill_id = $skill->id;
            $listen->exam_type_id = $exam_type_id;
            $listen->level_id = $level_id;
            $listen->class_id = $class_id;
            $listen->bookmap_id = $book_map_id;
            $listen->type_code = $type_code_next;

            $faker = Faker::create();
            $maxTime = $faker->unixTime($max = 'now');

            $file = Input::file();
            if (isset($file['listen_table_ticks'][$key]['url_audio'])) {
                $audio = $file['listen_table_ticks'][$key]['url_audio'];

                $filename_audio = $maxTime. '-'. $key. '-'. '-'. $audio->getClientOriginalName();
                $location_audio = public_path('backend/audio-listening/listen-table-ticks/');
                $audio->move($location_audio, $filename_audio);

                $path_url = 'backend/audio-listening/listen-table-ticks/'.$filename_audio;
                $listen->url = $path_url;
            }

            $listen->save();

            $new_id[] = $listen->id;
            $data_new['created_at'] = $listen->created_at;
            $data_new['url_avatar_user'] = $user->avatar;
        }

        $title_class = $classes->title;

        $level = Level::getLevelbyId($level_id);
        $level_title = $level->title;

        $data_new['user_id_receive'] = User::find_all_userId_by_code('AD');
        $data_new['url'] = route('backend.manager.author.get.detail', ['listen_table_ticks', $user_auth_id ,json_encode($new_id)]);
        $data_new['content'] = $user->user_name.' đã tạo câu hỏi cho phần Listen Table Ticks mức '.$level_title. ' cho ' . $title_class;

        Session::flash('message', 'Tạo thành công!');
        Session::flash('notification_new', $data_new);

        return Redirect()->route('backend.manager.author.listen.listen_table_ticks', $classes->code);
    }

    // lấy tên lớp qua id
    public function get_title_class($class_id) {
        $class = Classes::where(['id' => $class_id])->first();
        $class_title = $class->title;

        return $class_title;
    }

    public function update(Request $request) {
        $all_data = $request->all();
//dd($all_data);
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

        foreach ($all_data['listen_table_ticks'] as $key => $data) {
            $id_record = $data['id_record'];
            $listen = ListenTableTicks::where(['id' => $id_record])->first();

            $listen_content_question = $data['content-choose-ans-question'];

            $array_json = [];
            foreach ($listen_content_question as $idx => $item) {
                $array_json['suggest_choose'][] = $item['suggest'];

                if(isset($item['answer'])) {
                    $array_json['answer'][] = $item['suggest'];
                }
            }

            $listen->title = $data['title-listen-table-ticks'];
//            $listen->user_id_edit = $user_auth_id;
            $listen->type_user = $code_user;
            $listen->content_json = json_encode($array_json);
            $listen->skill_id = $skill->id;
            $listen->exam_type_id = $exam_type_id;
            $listen->level_id = $level_id;
            $listen->class_id = $class_id;
            $listen->bookmap_id = $book_map_id;
            if (Auth::user()->hasRole('AD')) {
                $listen->status = 1;
            } else {
                $listen->status = 0;
            }

            if(isset($data['url_audio'])) {
                $file = Input::file();

                if (isset($file['listen_table_ticks'][$key]['url_audio'])) {
                    $faker = Faker::create();
                    $maxTime = $faker->unixTime($max = 'now');

                    $audio = $file['listen_table_ticks'][$key]['url_audio'];

                    $filename_audio = $maxTime. '-'. $key. '-'. '-'. $audio->getClientOriginalName();
                    $location_audio = public_path('backend/audio-listening/listen-table-ticks/');
                    $audio->move($location_audio, $filename_audio);

                    $path_url = 'backend/audio-listening/listen-table-ticks/'.$filename_audio;
                    $listen->url = $path_url;
                }
            }

            $listen->save();

            if (Auth::user()->hasRole('AD')) {
                $new_id[] = $listen->id;
                $data_new['created_at'] = $listen->created_at;
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
            $data_new['url'] = route('backend.manager.author.get.detail', ['listen_table_ticks' , $all_data['authorspost'], $json_encode_id]);
            $data_new['content'] = 'Bài viết về Listen Table Ticks mức '. $level_title.  ' cho '. $title_class .' của bạn đã được chấp nhận ';

            Session::flash('notification_new', $data_new);

            $user = User::type_user();
            $user_author = $user['user_author'];
            $user_student = $user['user_student'];
            $user_admin = $user['user_admin'];

            $route = route('backend.manager.author.get.detail', ['listen_table_ticks' , $all_data['authorspost'], $json_encode_id]);
            return Redirect::to($route)
                ->with(['user_author' => $user_author,
                    'user_student' => $user_student,
                    'user_admin' => $user_admin]);

        } else {
            $ans_questions_all = ListenTableTicks::where(['type_user' => 'ST'])->with('skills', 'levels')
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

            $class_code = $classes->code;
            if ($class_code == 1) {
                $name_code = 'Elementary';
            } elseif ($class_code == 2) {
                $name_code = 'Secondary';
            } elseif ($class_code == 3) {
                $name_code = 'High School ';
            }

            return Redirect::to('backend/manager-author/listening/listen_table_ticks/'.$class_code)
                ->with(['class_code' => $class_code,
                    'name_code' => $name_code,
                    'array_id_intypecode' => $array_id_intypecode]);
        }
    }


}
