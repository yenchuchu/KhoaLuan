<?php

namespace App\Http\Controllers\backend\author;

use App\BookMap;
use App\Classes;
use App\ExamType;
use App\Http\Controllers\Controller;
use App\Level;
use App\ListenTicks;
use App\Skill;
use App\User;
use Illuminate\Http\Request;
use Route;
use Config;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;

class ListenTicksController extends Controller
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
        $ans_questions_all = ListenTicks::where(['type_user' => 'ST'])->with('skills', 'levels')
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

        return view('backend.author.listen.listen-tick.index',
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

        return view('backend.author.listen.listen-tick.create', compact('levels', 'class_code', 'code_user', 'classes'));
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
//        dd($all_data);

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

        $type_code_next = $this->get_typecode_next('listen_ticks');
        $user_auth_id = Auth::user()->id;

        foreach ($all_data['listen_ticks'] as $key => $data) {

            $listen = new ListenTicks();

            $listen_content_question = $data['content-choose-ans-question'];
//            dd($listen_content_question);

            foreach ($listen_content_question as $idx => $item) {
                $file = Input::file();
//                dd($file['listen_ticks'][$key]['content-choose-ans-question'][$idx]);
                if (isset($file['listen_ticks'][$key]['content-choose-ans-question'][$idx]['A'])) {
                    $file_a = $file['listen_ticks'][$key]['content-choose-ans-question'][$idx]['A'];
//                    dd($file_a);
                    $destinationPath_a = public_path('backend/img-listen'); // upload path
                    $extension_a = $file_a->getClientOriginalExtension(); // getting image extension
                    $filename_img_a = $user_auth_id . '-listen-ticks-A-' . '.' . $extension_a;

                    $listen_content_question[$idx]['A'] = $filename_img_a;
//                    $file_a->move($destinationPath_a, $filename_img_a);
                }

                if (isset($file['listen_ticks'][$key]['content-choose-ans-question'][$idx]['B'])) {
                    $file_b = $file['listen_ticks'][$key]['content-choose-ans-question'][$idx]['B'];
                    $destinationPath_b = public_path('backend/img-listen'); // upload path
                    $extension_b = $file_b->getClientOriginalExtension(); // getting image extension
                    $filename_img_b = $user_auth_id . '-listen-ticks-B-' . '.' . $extension_b;

                    $listen_content_question[$idx]['B'] = $filename_img_b;
//                    $file_b->move($destinationPath_b, $filename_img_b);
                }

                if (isset($file['listen_ticks'][$key]['content-choose-ans-question'][$idx]['url_audio'])) {
                    $audio = $file['listen_ticks'][$key]['content-choose-ans-question'][$idx]['url_audio'];

                    $filename_audio = $audio->getClientOriginalName();
                    $location_audio = public_path('backend/audio-listening/listen-ticks/');
                    $listen_content_question[$idx]['url_audio'] = 'backend/audio-listening/listen-ticks/'.$filename_audio;

//                    $audio->move($location_audio, $filename_audio);
                }
            }
dd($listen_content_question);
            $listen->title = $data['title-listen-ticks'];
            $listen->user_id = $user_auth_id;
            $listen->type_user = $code_user;
            $listen->content_json = json_encode($listen_content_question);
            $listen->skill_id = $skill->id;
            $listen->exam_type_id = $exam_type_id;
            $listen->level_id = $level_id;
            $listen->class_id = $class_id;
            $listen->bookmap_id = $book_map_id;
            $listen->type_code = $type_code_next;

            $listen->save();
        }

        Session::flash('message', 'Tạo thành công!');
        return Redirect()->route('backend.manager.author.listen.listen_ticks', $classes->code);
    }

    // mỗi lần add -> tạo 1 code.
    public function get_typecode_next($name_table) {
        $type_code = DB::table($name_table)->max('type_code');
        $type_next = $type_code + 1;

        return $type_next;
    }


}
