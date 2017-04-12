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
use Session;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Redirect;

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
        $ans_questions_all = ListenCompleteSentences::getRecordByUserId(Auth::user()->id);

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

        return view('backend.author.listen.complete-sentences.index',
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
        $classes = Classes::getClassById($class_id);

        $type_code_next = User::get_typecode_next('listen_complete_sentences');

        $user =  Auth::user();
        $user_auth_id = $user->id;

        $data_new = [];
        $new_id = [];
        $data_new['user_id'] = $user_auth_id;

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
                $faker = Faker::create();
                $maxTime = $faker->unixTime($max = 'now');

                if (isset($audio_files['listen_complete_sentences'][$key])) {
                    $audio = $audio_files['listen_complete_sentences'][$key];

                    $filename = $maxTime.'-'.$audio['audio']->getClientOriginalName();
                    $location = public_path('backend/audio-listening/listen-complete-sentences/');
                    $audio['audio']->move($location, $filename);
                    $listen->url = 'backend/audio-listening/listen-complete-sentences/'.$filename;
                }
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
        $data_new['url'] = route('backend.manager.author.get.detail', ['listen_complete_sentences', $user_auth_id ,json_encode($new_id)]);
        $data_new['content'] = $user->user_name.' đã tạo câu hỏi cho phần Listen Complete Sentences mức '.$level_title. ' cho ' . $title_class;

        Session::flash('message', 'Tạo thành công!');
        Session::flash('notification_new', $data_new);

        return Redirect()->route('backend.manager.author.listen.listen_complete_sentences', $classes->code);
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

        foreach ($all_data['listen_complete_sentences'] as $key => $data) {
            $id_record = $data['id_record'];
            $listen = ListenCompleteSentences::where(['id' => $id_record])->first();

            $listen_content_question = $data['content-choose-ans-question'];

            $listen->title = $data['title-listen-complete-sentences'];
            $listen->type_user = $code_user;
            $listen->content_json = json_encode($listen_content_question);
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

            if (isset($data['audio'])) {
                $faker = Faker::create();
                $maxTime = $faker->unixTime($max = 'now');

                $audio_files = Input::file();

                if (isset($audio_files['listen_complete_sentences'][$key])) {
                    $audio = $audio_files['listen_complete_sentences'][$key];

                    $filename = $maxTime.'-'.$audio['audio']->getClientOriginalName();
                    $location = public_path('backend/audio-listening/listen-complete-sentences/');
                    $audio['audio']->move($location, $filename);
                    $listen->url = 'backend/audio-listening/listen-complete-sentences/'.$filename;
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
            $data_new['url'] = route('backend.manager.author.get.detail', ['listen_complete_sentences' , $all_data['authorspost'], $json_encode_id]);
            $data_new['content'] = 'Bài viết về Listen Complete Sentences mức '. $level_title.  ' cho '. $title_class .' của bạn đã được chấp nhận ';

            Session::flash('notification_new', $data_new);

            $user = User::type_user();
            $user_author = $user['user_author'];
            $user_student = $user['user_student'];
            $user_admin = $user['user_admin'];

            $route = route('backend.manager.author.get.detail', ['listen_complete_sentences' , $all_data['authorspost'], $json_encode_id]);
            return Redirect::to($route)
                ->with(['user_author' => $user_author,
                    'user_student' => $user_student,
                    'user_admin' => $user_admin]);

        } else {
            $ans_questions_all = ListenCompleteSentences::where(['type_user' => 'ST'])->with('skills', 'levels')
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

            return Redirect::to('backend/manager-author/listening/listen_complete_sentences')
                ->with(['array_id_intypecode' => $array_id_intypecode]);
        }
    }

}
