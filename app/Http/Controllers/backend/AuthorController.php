<?php

namespace App\Http\Controllers\backend;

use App\Classes;
use App\Http\Controllers\Controller;
use App\Level;
use App\Speaking;
use App\User;
use Auth;
use Config;
use DB;
use Illuminate\Http\Request;
use Route;

use App\AnswerQuestion;
use App\FindError;
use App\ListenCompleteSentences;
use App\ListenTicks;
use App\ListenTableTicks;
use App\TickCircleTrueFalse;
use App\MultipleChoice;

class AuthorController extends Controller
{

    protected $posts;
    protected $skill_read;
    protected $skill_listen;

    public function __construct()
    {
        $this->skill_read = Config::get('constants.skill.Read');
        $this->skill_listen = Config::get('constants.skill.Listen');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id_auth = Auth::user()->id;

        $ans_question = AnswerQuestion::getRecordByUserId($user_id_auth);
        $tal_ans_question = count($ans_question);

        $find_error = FindError::getRecordByUserId($user_id_auth);
        $tal_find_error = count($find_error);

        $multiple = MultipleChoice::getRecordByUserId($user_id_auth);
        $tal_multiple = count($multiple);

        $tick_true_false = TickCircleTrueFalse::getRecordByUserId($user_id_auth);
        $tal_tick_true_false = count($tick_true_false);

        $listen_complete = ListenCompleteSentences::getRecordByUserId($user_id_auth);
        $tal_listen_complete = count($listen_complete);

        $listen_ticks = ListenTicks::getRecordByUserId($user_id_auth);
        $tal_listen_ticks = count($listen_ticks);

        $listen_table_ticks = ListenTableTicks::getRecordByUserId($user_id_auth);
        $tal_listen_table_ticks  = count($listen_table_ticks );

        $speaks = Speaking::getRecordByUserId($user_id_auth);
        $tal_speaks = count($speaks);

        return view('backend.author.grade-menu', compact('tal_ans_question', 'tal_find_error', 'tal_multiple', 'tal_tick_true_false',
            'tal_listen_complete', 'tal_listen_ticks', 'tal_listen_table_ticks', 'tal_speaks'));
//        return view('backend.author.index');
    }

    public function show_post()
    {

        $all_posts = [];
        $type_reads = $this->skill_read;
        $user_id = Auth::user()->id;

        foreach ($type_reads as $name_table => $item) {
            $data_table = DB::table($name_table)
                ->where(['user_id' => $user_id])
                ->orderBy('created_at', 'desc')
                ->get();

            foreach ($data_table as $item) {
                $item->table = $name_table;
                $all_posts['read'][] = $item;
            }
        }

        $type_listens = $this->skill_listen;
        foreach ($type_listens as $name_table => $item) {
            $data_table = DB::table($name_table)
                ->where(['user_id' => $user_id])
                ->orderBy('created_at', 'desc')
                ->get();

            foreach ($data_table as $item) {
                $item->table = $name_table;
                $all_posts['listen'][] = $item;
            }
        }

        $data_table_speaks = Speaking::where(['user_id' => $user_id])->orderBy('created_at', 'desc')->get();
        foreach ($data_table_speaks as $item) {
            $item->table = 'speakings';
            $all_posts['speak'][] = $item;
        }

        return view('backend.author.show-post', compact('all_posts'));
    }

    public function get_detail() {
        $url_parameters = Route::getCurrentRoute()->parameters();

        $name_table = $url_parameters['name_table'];
        $author_id = $url_parameters['user_auth_id'];
        $id_string = $url_parameters['id_string'];

        $id_string =  str_replace("[","",$id_string);
        $id_string =  str_replace("]","",$id_string);
        $array_id = explode(",",$id_string);
        $id_all = [];
        foreach ($array_id as $id_s) {
            $id_all[] = (int)$id_s;
        }

        $records = DB::table($name_table)->whereIn('id', $id_all)->orderBy('created_at', 'desc')->get();
        $class_id = $records[0]->class_id;
        $level_id = $records[0]->level_id;
        $status = $records[0]->status;

        $class_code = $this->get_code_class($class_id);

        $levels = Level::all();
        $classes = Classes::all();
        $code_user = 'ST'; // default

        return view('backend.author.show-post.index', compact(
            'records', 'levels', 'classes', 'name_table', 'class_code', 'code_user',
            'class_id', 'level_id', 'id_string', 'author_id', 'status'));
    }

    public function get_code_class($class_id) {
        $class = Classes::where(['id' => $class_id])->first();
        $code_class = $class->code;

        return $code_class;
    }

    public function post_detail(Request $request)
    {
       $data = $request->all();
        $name_table = $data['table'];
        $array_id = json_decode($data['array_id']);

        $record = DB::table($name_table)->whereIn('id', $array_id)->get();
        dd($record);
        $record->table = $data['table'];
        $levels = Level::all();
        $classes = Classes::all();

        return view('backend.author.post-detail', compact('record', 'levels', 'classes'));
    }

    public function answer_question()
    {
        return view('backend.author.answer_question.index');
    }

    public function answer_question_create()
    {
        return view('backend.author.answer_question.create');
    }

    public function classify_words()
    {
        return view('backend.author.classify_words');
    }

    public function complete_words()
    {
        return view('backend.author.complete_words');
    }

    public function find_errors()
    {
        return view('backend.author.find_errors');
    }

    public function multiple_choice()
    {
        return view('backend.author.multiple_choice');
    }

    public function tick_circle_true_false()
    {
        return view('backend.author.tick_circle_true_false');
    }

    public function underlines()
    {
        return view('backend.author.underlines');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function grade(Request $request)
    {
        $this->url_parameters = Route::getCurrentRoute()->parameters();
        $class_code = $this->url_parameters['class_code'];
        if ($class_code == 1) {
            $name_code = 'Elementary';
        } elseif ($class_code == 2) {
            $name_code = 'Secondary';
        } elseif ($class_code == 3) {
            $name_code = 'High School ';
        }

        return view('backend.author.grade-menu',
            compact('class_code', 'name_code'));
    }

//    public function create() {
//
//        $header_examp_type = ExamType::select('Header')->where('ID', '=', 1)->first();
//        $exam_format = ExamFormat::where('ID', '=', 2)->first();
//
//        return view('elementary.create', compact('header_examp_type', 'exam_format'));
//    }

    public function secondary()
    {

        return view('frontend.secondary.index');
    }

    public function highschool()
    {

        return view('frontend.highschool.index');
    }

    public function show_all_noti() {

    }


}
