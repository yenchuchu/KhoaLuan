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
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Input;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

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
        $ans_questions_all = ListenTicks::getRecordByUserId(Auth::user()->id);

        $type_codes = $ans_questions_all->groupBy('type_code');

        $array_id_intypecode = [];
        foreach ($type_codes as $code=> $item) {
            $array_id_intypecode[$code]['id'] = json_encode($item->pluck('id')->toArray());
            $array_id_intypecode[$code]['class_id'] = array_unique($item->pluck('class_id')->toArray());
            $array_id_intypecode[$code]['level_id'] = array_unique($item->pluck('level_id')->toArray());
            $array_id_intypecode[$code]['status'] = array_unique($item->pluck('status')->toArray());
            $array_id_intypecode[$code]['created_at'] = array_unique($item->pluck('created_at')->toArray());
        }

        return view('backend.author.listen.listen-tick.index',
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

        $type_code_next = User::get_typecode_next('listen_ticks');

        $user =  Auth::user();
        $user_auth_id = $user->id;

        $data_new = [];
        $new_id = [];
        $data_new['user_id'] = $user_auth_id;

        foreach ($all_data['listen_ticks'] as $key => $data) {
            $listen = new ListenTicks();

            $listen_content_question = $data['content-choose-ans-question'];
            $file = Input::file();

            foreach ($listen_content_question as $idx => $item) {
                $faker = Faker::create();
                $maxTime = $faker->unixTime($max = 'now');

                if (isset($file['listen_ticks'][$key]['content-choose-ans-question'][$idx]['content']['A'])) {
                    $file_a = $file['listen_ticks'][$key]['content-choose-ans-question'][$idx]['content']['A'];
                    $destinationPath_a = public_path('backend/img-listen'); // upload path
                    $extension_a = $file_a->getClientOriginalExtension(); // getting image extension
                    $filename_img_a = $user_auth_id . '-listen-ticks-A-' .$maxTime. '-'. $key. '-'. $idx. '.'. $extension_a;

                    $listen_content_question[$idx]['content']['A'] = 'backend/img-listen/'.$filename_img_a;
                    $file_a->move($destinationPath_a, $filename_img_a);
                }

                if (isset($file['listen_ticks'][$key]['content-choose-ans-question'][$idx]['content']['B'])) {
                    $file_b = $file['listen_ticks'][$key]['content-choose-ans-question'][$idx]['content']['B'];
                    $destinationPath_b = public_path('backend/img-listen'); // upload path
                    $extension_b = $file_b->getClientOriginalExtension(); // getting image extension
                    $filename_img_b = $user_auth_id . '-listen-ticks-B-' .$maxTime. '-'. $key. '-'. $idx. '.' . $extension_b;

                    $listen_content_question[$idx]['content']['B'] = 'backend/img-listen/'.$filename_img_b;
                    $file_b->move($destinationPath_b, $filename_img_b);
                }
            }

            if (isset($file['listen_ticks'][$key]['url_audio'])) {
                $audio = $file['listen_ticks'][$key]['url_audio'];

                $filename_audio = $maxTime. '-'. $key. '-'. $idx. '-'. $audio->getClientOriginalName();
                $location_audio = public_path('backend/audio-listening/listen-ticks/');
                $audio->move($location_audio, $filename_audio);

                $path_url = 'backend/audio-listening/listen-ticks/'.$filename_audio;
                $listen->url = $path_url;
            }

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

            $new_id[] = $listen->id;
            $data_new['created_at'] = $listen->created_at;
            $data_new['url_avatar_user'] = $user->avatar;
        }

        $title_class = $classes->title;

        $level = Level::getLevelbyId($level_id);
        $level_title = $level->title;

        $data_new['user_id_receive'] = User::find_all_userId_by_code('AD');
        $data_new['url'] = route('backend.manager.author.get.detail', ['listen_ticks', $user_auth_id ,json_encode($new_id)]);
        $data_new['content'] = $user->user_name.' đã tạo câu hỏi cho phần Listen Ticks mức '.$level_title. ' cho ' . $title_class;

        Session::flash('message', 'Tạo thành công!');
        Session::flash('notification_new', $data_new);

        return Redirect()->route('backend.manager.author.listen.listen_ticks', $classes->code);
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

        foreach ($all_data['listen_ticks'] as $key => $data) {
            $id_record = $data['id_record'];
            $listen = ListenTicks::where(['id' => $id_record])->first();

            $listen_content_question = $data['content-choose-ans-question'];
            $content_json_old = json_decode($listen->content_json);

            $array_json_old = [];
            foreach ($content_json_old as $key_j => $json_old) {
                $array_json_old[$key_j]['id'] = $json_old->id;
                $array_json_old[$key_j]['content']['A'] = $json_old->content->A;
                $array_json_old[$key_j]['content']['B'] = $json_old->content->B;
                $array_json_old[$key_j]['answer'] = $json_old->answer;
                $array_json_old[$key_j]['url_audio'] = $json_old->url_audio;
            }

            foreach ($listen_content_question as $idx => $item) {

                if(!isset($item['content'])) {
                    $listen_content_question[$idx]['content'] = $array_json_old[$idx]['content'];
                } else {
                    $file = Input::file();
                    $faker = Faker::create();
                    $maxTime = $faker->unixTime($max = 'now');

                    if(!isset($item['content']['A'])) {
                        $listen_content_question[$idx]['content']['A'] = $array_json_old[$idx]['content']['A'];
                    } else {
                        $file_a = $file['listen_ticks'][$key]['content-choose-ans-question'][$idx]['content']['A'];
                        $destinationPath_a = public_path('backend/img-listen'); // upload path
                        $extension_a = $file_a->getClientOriginalExtension(); // getting image extension
                        $filename_img_a = $user->id . '-listen-ticks-A-' .$maxTime. '-'. $key. '-'. $idx. '.'. $extension_a;

                        $listen_content_question[$idx]['content']['A'] = 'backend/img-listen/'.$filename_img_a;
                        $file_a->move($destinationPath_a, $filename_img_a);
                    }

                    if(!isset($item['content']['B'])) {
                        $listen_content_question[$idx]['content']['B'] = $array_json_old[$idx]['content']['B'];
                    } else {
                        $file_b = $file['listen_ticks'][$key]['content-choose-ans-question'][$idx]['content']['B'];
                        $destinationPath_b = public_path('backend/img-listen'); // upload path
                        $extension_b = $file_b->getClientOriginalExtension(); // getting image extension
                        $filename_img_b = $user->id . '-listen-ticks-B-' .$maxTime. '-'. $key. '-'. $idx. '.' . $extension_b;

                        $listen_content_question[$idx]['content']['B'] = 'backend/img-listen/'.$filename_img_b;
                        $file_b->move($destinationPath_b, $filename_img_b);
                    }
                }

                if(!isset($item['url_audio'])) {
                    $listen_content_question[$idx]['url_audio'] = $array_json_old[$idx]['url_audio'];
                } else {
                    $faker = Faker::create();
                    $maxTime = $faker->unixTime($max = 'now');
                    $file = Input::file();

                    $audio = $file['listen_ticks'][$key]['content-choose-ans-question'][$idx]['url_audio'];

                    $filename_audio = $maxTime. '-'. $key. '-'. $idx. '-'. $audio->getClientOriginalName();
                    $location_audio = public_path('backend/audio-listening/listen-ticks/');
                    $listen_content_question[$idx]['url_audio'] = 'backend/audio-listening/listen-ticks/'.$filename_audio;
                    $audio->move($location_audio, $filename_audio);
                }
            }

            $listen->title = $data['title-listen-ticks'];
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
            $data_new['url'] = route('backend.manager.author.get.detail', ['listen_ticks' , $all_data['authorspost'], $json_encode_id]);
            $data_new['content'] = 'Bài viết về Listen Ticks mức '. $level_title.  ' cho '. $title_class .' của bạn đã được chấp nhận ';

            Session::flash('notification_new', $data_new);

            $user = User::type_user();
            $user_author = $user['user_author'];
            $user_student = $user['user_student'];
            $user_admin = $user['user_admin'];

            $route = route('backend.manager.author.get.detail', ['listen_ticks' , $all_data['authorspost'], $json_encode_id]);
            return Redirect::to($route)
                ->with(['user_author' => $user_author,
                    'user_student' => $user_student,
                    'user_admin' => $user_admin]);

        } else {
            $ans_questions_all = ListenTicks::where(['type_user' => 'ST'])->with('skills', 'levels')
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

            return Redirect::to('backend/manager-author/listening/listen_ticks')
                ->with(['array_id_intypecode' => $array_id_intypecode]);
        }
    }


}
