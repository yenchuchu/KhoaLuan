<?php

namespace App\Http\Controllers\backend\author;

use App\BookMap;
use App\Classes;
use App\ExamType;
use App\Http\Controllers\Controller;
use App\Level;
use App\ListenCompleteSentences;
use App\Skill;
use App\User;
use Illuminate\Http\Request;
use Route;
use Config;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;

class ListenCompleteSentencesController extends Controller
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
        $ans_questions_all = ListenCompleteSentences::where(['type_user' => 'ST'])->with('skills', 'levels')
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

        //        $ans_for_students = [];
//        foreach ($for_students as $ans) {
//            $ans->content_json = json_decode($ans->content_json);
//            $ans->skills = $ans->skills->first();
//            $ans->levels = $ans->levels->first();
//
//            $ans_for_students[] = $ans;
//        }

        $class_code = $this->url_parameters['class_code'];
        if ($class_code == 1) {
            $name_code = 'Elementary';
        } elseif ($class_code == 2) {
            $name_code = 'Secondary';
        } elseif ($class_code == 3) {
            $name_code = 'High School ';
        }

        return view('backend.author.listen.complete-sentences.index',
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

            return view('backend.author.answer_question.create',
                compact('levels', 'class_code', 'code_user', 'classes', 'exam_types', 'book_maps'));
        }

        return view('backend.author.listen.complete-sentences.create', compact('levels', 'class_code', 'code_user', 'classes'));
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

        $type_code_next = $this->get_typecode_next('listen_complete_sentences');

        foreach ($all_data['listen_complete_sentences'] as $key => $data) {

            $listen_content_question = $data['content-choose-ans-question'];

            $listen = new ListenCompleteSentences();

            $listen->title = $data['title-listen-complete-sentences'];
            $listen->user_id = Auth::user()->id;
            $listen->type_user = $code_user;
            $listen->content_json = json_encode($listen_content_question);
            $listen->skill_id = $skill->id;
            $listen->exam_type_id = $exam_type_id;
            $listen->level_id = $level_id;
            $listen->class_id = $class_id;
            $listen->bookmap_id = $book_map_id;
            $listen->type_code = $type_code_next;

            $audio_files = Input::file();
            if (!empty($audio_files)) {

                if (isset($audio_files['listen_complete_sentences'][$key])) {
                    $audio = $audio_files['listen_complete_sentences'][$key];

                    $filename = $audio['audio']->getClientOriginalName();
                    $location = public_path('backend/audio-listening/');
                    $audio['audio']->move($location, $filename);
                    $listen->url = 'backend/audio-listening/'.$filename;
                }
            }

            $listen->save();
        }

        return Redirect()->route('backend.manager.author.listen.listen_complete_sentences', $classes->code);
    }

    // mỗi lần add -> tạo 1 code.
    public function get_typecode_next($name_table) {
        $type_code = DB::table($name_table)->max('type_code');
        $type_next = $type_code + 1;

        return $type_next;
    }


}
