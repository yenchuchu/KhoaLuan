<?php

namespace App\Http\Controllers\backend\author;

use App\BookMap;
use App\Classes;
use App\ExamType;
use App\Http\Controllers\Controller;
use App\Level;
use App\ListenTableTicks;
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
        $ans_questions_all = ListenTableTicks::where(['type_user' => 'ST'])->with('skills', 'levels')
            ->orderBy('type_code', 'desc')
            ->get();

        $type_codes = $ans_questions_all->groupBy('type_code');

        $array_id_intypecode = [];
        foreach ($type_codes as $code=> $item) {
            $array_id_intypecode[$code]['id'] = $item->pluck('id')->toArray();
            $array_id_intypecode[$code]['class_id'] = array_unique($item->pluck('class_id')->toArray());
            $array_id_intypecode[$code]['level_id'] = array_unique($item->pluck('level_id')->toArray());
            $array_id_intypecode[$code]['status'] = array_unique($item->pluck('status')->toArray());
            $array_id_intypecode[$code]['created_at'] = array_unique($item->pluck('created_at')->toArray());
        }

        $class_code = $this->url_parameters['class_code'];
        if ($class_code == 1) {
            $name_code = 'Elementary';
        } elseif ($class_code == 2) {
            $name_code = 'Secondary';
        } elseif ($class_code == 3) {
            $name_code = 'High School ';
        }

        return view('backend.author.listen.table-tick.index',
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
        $classes = Classes::whereId($class_id)->first();

        $type_code_next = $this->get_typecode_next('listen_table_ticks');
        $user =  Auth::user();
        $user_auth_id = $user->id;

        $data_new = [];
        $new_id = [];
        $data_new['user_id'] = $user_auth_id;
//        $data_new['name_table'] = 'listen_table_ticks';
        $data_new['status'] = 0;
//        $data_new['type_code'] = $type_code_next;

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
//            $data_new['user_name'] = $user->user_name;
            $data_new['url_avatar_user'] = $user->avatar;


        }

        $data_new['url'] = route('backend.manager.author.get.detail', ['listen_table_ticks', $type_code_next ,json_encode($new_id)]);
        $data_new['content'] = $user->user_name.' posted a exam.';



//        $data_new_json = json_encode($data_new);
//        dd($data_new_json);

        Session::flash('message', 'Tạo thành công!');
        Session::flash('notification_new', $data_new);
        return Redirect()->route('backend.manager.author.listen.listen_table_ticks', $classes->code);
    }

    // mỗi lần add -> tạo 1 code.
    public function get_typecode_next($name_table) {
        $type_code = DB::table($name_table)->max('type_code');
        $type_next = $type_code + 1;

        return $type_next;
    }


}
