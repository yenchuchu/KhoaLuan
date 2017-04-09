<?php

namespace App\Http\Controllers\frontend;

use App\Classes;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Item;
use App\Level;
use App\Skill;
use App\Speaking;
use App\User;
use App\UserSkill;
use Auth;
use Config;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Route;
use Session;


class StudentController extends Controller
{

    protected $skill_read;
    protected $skill_listen;
    protected $code_student;
    protected $levels;
    protected $lama;

    public function __construct()
    {
        $this->skill_read = Config::get('constants.skill.Read');
        $this->skill_listen = Config::get('constants.skill.Listen');
        $this->lama = Config::get('constants.lama');
        $this->code_student = 'ST';
        $this->levels = Level::all();
    }

    public function index()
    {
        $class_id = Auth::user()->class_id;
        $levels = $this->levels;

        return view('frontend.student.index', compact('class_id', 'levels'));
    }

    public function learn_speak()
    {

        $skill_id = $this->getSkillIdByCode('Speak');

        $user = Auth::user();
        $user_id = $user->id;

        $class_id = Auth::user()->class_id;
        $levels = $this->levels;

        $skills = $user->user_skills()->where(['skill_id' => $skill_id])->get();
        $max_code = $this->getMaxCodeTest($skills);

        // Lấy kết quả lần thi gần đây nhất.
        $filter_skills = $skills->filter(function ($skill) use ($user_id, $max_code) {
            $test_id = $user_id . '_' . $max_code;

            return $skill->user_id == $user_id && $skill->test_id == $test_id;
        })->all();

        if (!empty($filter_skills)) {
            foreach ($filter_skills as $filter) {
                $get_next_level = $this->checkLevel($filter['point'], $filter['level_id'], 5);
            }
        } else {
            $code_level = 'L2';
            $level = Level::where(['code' => $code_level])->first();
            $get_next_level = $level->id;
        }

        $speak_items = Speaking::where([
            'class_id' => $class_id,
            'type_user' => $this->code_student,
            'level_id' => $get_next_level,
            'status' => 1
        ])->get()->toArray();

        if (!empty($speak_items)) {
            $key_speak_item = array_rand($speak_items, 1);
            $speak_item = $speak_items[$key_speak_item];

            $item = Speaking::where(['id' => $speak_item['id']])->first();
            if ($item->url_mp3 == null) {
                $tts = new VoiceRSS;
                $voice = $tts->speech([
                    'key' => 'd78f3419c63f4a35978e295ec139fc06',
                    'hl' => 'en-us',
                    'src' => $item->content,
                    'r' => '0',
                    'c' => 'mp3',
                    'f' => '44khz_16bit_stereo',
                    'ssml' => 'false',
                    'b64' => 'true'
                ]);

                $item->url_mp3_create = $voice['response'];
            }
        } else {
            $item = null;
        }

        return view('frontend.student.speak_skill', compact('class_id', 'levels', 'get_next_level', 'item'));
    }

    public function check_text_speech(Request $request)
    {
        $all_request = $request->all();
        $text_demo = $all_request['text_demo'];
        $text_speak = $all_request['text_speak'];
        $level_now = $all_request['level_now'];

        if (strcmp($text_demo, $text_speak) == 0) {
            $point = 10;
            $result_diff = null;
        } else {
            $diff = $this->get_decorated_diff($text_demo, $text_speak);
            $result_diff = $diff['new'];
            $point = $diff['point'];
        }

        $add_user_skill = new UserSkill();

        $skill_id = $this->getSkillIdByCode('Speak');
        $user = Auth::user();
        $user_id = $user->id;

        $skills = $user->user_skills()->where(['skill_id' => $skill_id])->get();
        $max_code = $this->getMaxCodeTest($skills) + 1;

        // lấy số lần đã thi của user
        $test_id = $user_id . "_" . $max_code;

        $add_user_skill->user_id = $user_id;
        $add_user_skill->level_id = $level_now;
        $add_user_skill->status = 1;
        $add_user_skill->test_id = $test_id;

        $add_user_skill->point = $point;
        $add_user_skill->skill_id = $skill_id;

        $add_user_skill->save();

        return response()->json([
            'code' => 200,
            'result' => $result_diff,
            'message' => 'Score: ' . $point
        ]);
    }

    function get_decorated_diff($old, $new)
    {
        $count_word_old = str_word_count($old);
//
        $from_start = strspn($old ^ $new, "\0");
        $from_end = strspn(strrev($old) ^ strrev($new), "\0");

        $old_end = strlen($old) - $from_end;
        $new_end = strlen($new) - $from_end;

        $start = substr($new, 0, $from_start);
        $end = substr($new, $new_end);
        $new_diff = substr($new, $from_start, $new_end - $from_start);
//        $old_diff = substr($old, $from_start, $old_end - $from_start);
//dd($new_diff);
        $count_word_correct = str_word_count($start) + str_word_count($end); // nên check cả số từ sai nữa để trừ điểm.
//        dd($count_word_correct);
//        var_dump($count_word_correct);
        if ($count_word_correct == 0) {
            $point = 0;
        } else {
            $point = ($count_word_correct * 10) / $count_word_old;
        }

        $new = "<span id='final_span' class='final'>$start<span style='background-color: rgba(249, 150, 117, 0.49);'>$new_diff</span>$end</span>";

//        dd($new_diff);
//        $new = $start . " - " . $new_diff . " - " . $end;
//        $old = "$start<del style='background-color:#ffcccc'>$old_diff</del>$end";
        return array("old" => $old, "new" => $new, "point" => round($point, 2), "new_diff" => $new_diff);
//
//        return array('1','2');

    }

    public function checkLevel($point, $level_now, $point_item)
    {

        $level = Level::get()->pluck('id')->toArray();
        $key_max = count($level) - 1;

        foreach ($level as $key => $lv) {
            if ($lv == $level_now) {
                $key_now = $key;
            }
        }

        if ($point < $point_item) {
            if ($key_now == 0) {
                $level_next = $level[$key_now];
            } else {
                $level_next = $level[$key_now - 1];
            }
        } else {
            if ($key_now == $key_max) {
                $level_next = $level[$key_now];
            } else {
                $level_next = $level[$key_now + 1];
            }

        }

        return $level_next;
    }

    /**
     * XỬ LÍ KỸ NĂNG READING
     */

    // hàm hiển thị bài test hoặc bài test chưa hoàn thiện của học sinh- KỸ NĂNG READING
    public function redirectToTest(Request $request)
    {
        $this->url_parameters = Route::getCurrentRoute()->parameters();

        $skill_code = $this->url_parameters['skill_code'];
        $skill_id = $this->getSkillIdByCode($skill_code);

        $user = Auth::user();
        $user_id = $user->id;

        $class_id = Auth::user()->class_id;
        $levels = $this->levels;

        $skills = $user->user_skills()->where(['skill_id' => $skill_id])->get();
        $max_code = $this->getMaxCodeTest($skills);

        // Lấy kết quả lần thi gần đây nhất.
        $filter_skills = $skills->filter(function ($skill) use ($user_id, $max_code) {
            $test_id = $user_id . '_' . $max_code;

            return $skill->user_id == $user_id && $skill->test_id == $test_id;
        })->all();

        if (!empty($filter_skills)) {
            foreach ($filter_skills as $filter) {
                $get_next_level = $this->checkLevel($filter['point'], $filter['level_id'], 50);
            }
        } else {
            $code_level = 'L2';
            $level = Level::where(['code' => $code_level])->first();
            $get_next_level = $level->id;
        }

        // kiểm tra lượt thi đã tồn tại hay chưa ( được lưu ở bảng Items).
        $check_exist_item = Item::where(['user_id' => $user_id, 'skill_id' => $skill_id])->get();
        if (count($check_exist_item) == 0) {
            $type_exam_read = Config::get('constants.skill.' . $skill_code);
            $random_type_read = array_rand($type_exam_read, 3);

            $items = [];

            if (!isset($check_read)) {
//                echo " k ton tai";
                foreach ($random_type_read as $read) {
                    $read_table = DB::table($read)
                        ->where([
                            'class_id' => $class_id,
                            'type_user' => $this->code_student,
                            'level_id' => $get_next_level,
                            'status' => 1
                        ])->get()->toArray();

                    if (count($read_table) != 0) {
                        $max = count($read_table) - 1;
                        $rand = rand(0, $max);

                        $read_table[$rand]->table = $read;
                        if ($skill_code == 'Read') {
                            $items['Read'][] = $read_table[$rand];
                        } else {
                            $items['Listen'][] = $read_table[$rand];
                        }

                    }
                }

            } else {
                // read chỉ có 1 dạng bài.
                $read_table = DB::table($random_type_read)
                    ->where([
                        'class_id' => $class_id,
                        'type_user' => $this->code_student,
                        'level_id' => $get_next_level
                    ])
                    ->get()->toArray();

                if (count($read_table) != 0) {
                    $max = count($read_table) - 1;
                    $rand = rand(0, $max);

//                    $items['Read']['tables'][] = $random_type_read;
                    $read_table[$rand]->table = $random_type_read;
                    if ($skill_code == 'Read') {
                        $items['Read'][] = $read_table[$rand];
                    } else {
                        $items['Listen'][] = $read_table[$rand];
                    }

                }
            }

            $noti_not_complete = 0;
            $time_remaining = Config::get('constants.time_start');
        } elseif (count($check_exist_item) == 1) { // đã tồn tại

            $noti_not_complete = 1;
            $items_old = Item::where([
                'user_id' => $user_id,
                'skill_id' => $skill_id,
                'level_id' => $get_next_level
            ])->get();

            $items = [];
            foreach ($items_old as $item) {
                $json_decode_answer = json_decode($item->update_json_answer);
                $time_remaining = $item->time_remaining;
            }

            foreach ($json_decode_answer as $skill => $ans) {

                foreach ($ans as $table => $tb) {
                    $find = DB::table($table)->where([
                        'id' => $tb[0]->id_record
                    ])->first();

                    if ($find == null) {
                        Session::flash('message', 'Không thực hiện được hành động này!');

                        return redirect()->route('frontend.dashboard.student.index');
                    }

                    $find->table = $table;
                    foreach ($tb as $t) {
                        $find->old_answer[$t->id_question] = [
                            'id_question' => $t->id_question,
                            'answer_student' => $t->answer_student
                        ];
                    }

                    $items[$skill][$tb[0]->order] = $find;
                }
            }

        }

        $lamas = $this->lama;

        return view('frontend.student.join-test.index',
            compact('class_id', 'items', 'random_type_listen', 'random_type_read', 'skill_code', 'get_next_level',
                'noti_not_complete', 'time_remaining', 'lamas'));
    }

    // xử lí lưu liên tục kết quả làm bài 15s/lần của học sinh - KY NANG READING
    public function hanglingResult(Request $request)
    {

        $requets_all = $request->all();

        $array_tables = collect($requets_all['list_answer'])->pluck('name_table');
        $table_all = array_unique($array_tables->toArray());

        foreach ($requets_all['list_answer'] as $ans) {

            if ($ans['skill_name'] == 'Read') {
                foreach ($table_all as $table) {
                    if ($ans['name_table'] == $table) {

                        if (!isset($ans['answer_student'])) {
                            $ans['answer_student'] = '';
                        }

                        $data = [
                            'order' => $ans['number_title'], // số thứ tự của bài đang test. ( bài 1 bài 2)
                            'id_record' => $ans['id_record'],
                            'id_question' => $ans['id_question'],
                            'answer_student' => $ans['answer_student']
                        ];
                        $json_answer['Read'][$table][] = $data;
                    }
                }
            } else {
                if ($ans['skill_name'] == 'Listen') {
                    foreach ($table_all as $table) {
                        if ($ans['name_table'] == $table) {

                            if (!isset($ans['answer_student'])) {
                                $ans['answer_student'] = '';
                            }

                            $data = [
                                'order' => $ans['number_title'], // số thứ tự của bài đang test. ( bài 1 bài 2)
                                'id_record' => $ans['id_record'],
                                'id_question' => $ans['id_question'],
                                'answer_student' => $ans['answer_student']
                            ];
                            $json_answer['Listen'][$table][] = $data;
                        }
                    }
                }
            }

        }
//dd($json_answer);
        $json_answer_encode = json_encode($json_answer);
        $user_id = Auth::user()->id;
        $level_id = $requets_all['level_id'];
        $time_remaining = $requets_all['time_remaning']; // thời gian còn lại của học sinh để làm bài

        if ($requets_all['submit'] == 1) {
            $done = 1; // học sinh nộp bài
        } else {
            if ($time_remaining == -1) {
                $done = 1; // hết thơi gian làm bài
            } else {
                if ($time_remaining != -1) {
                    $done = 0; // chưa hết tgian và học sinh cũng chưa nộp bài
                }
            }
        }

        $skill_id_item = $this->getSkillIdByCode($ans['skill_name']);

        $check_item_exist = Item::where(['user_id' => $user_id, 'skill_id' => $skill_id_item])->get();
        if ($done == 0) {
            if (count($check_item_exist) == 0) {
                $items = new Item();

                $items->level_id = $level_id;
                $items->skill_id = $skill_id_item;
                $items->user_id = $user_id;
                $items->time_remaining = $time_remaining;
                $items->update_json_answer = $json_answer_encode;

                $items->save();
            } else {
                $data = [
                    'time_remaining' => $time_remaining,
                    'update_json_answer' => $json_answer_encode
                ];

                Item::where([
                    'user_id' => $user_id,
                    'skill_id' => $skill_id_item,
                    'level_id' => $level_id
                ])
                    ->update($data);
            }
        } else {
            // sau khi học sinh nhấn submit hoặc hết tgian
            $sum_point = Config::get('constants.sum_point'); // điểm của mỗi bài trong mỗi kỹ năng
            $add_user_skill = new UserSkill();

            // gọi hàm đối chiếu đáp án & tính điểm
            $result_answer = $this->checkAnswer($json_answer);
            $point_skills = $result_answer['point'];
            $point_total = $result_answer['point_total'];

            $fix_answer_error = $result_answer['check_correct'];

            $array_point_skills = [];
            $i_item = 1;
            foreach ($point_skills as $skill => $point) {

                $skill_id = $this->getSkillIdByCode($skill);
//                $find_skill = Skill::where(['code' => $skill])->first();
                $array_point_skills[$i_item] = [
                    'skill_id' => $skill_id,
                    'point' => $point
                ];

                $i_item++;
            }
            // chưa có bài test cho phần Listening => gán tạm
            $array_point_skills[2] = [
                'skill_id' => 1,
                'point' => 20
            ];

            $encode_point = json_encode($array_point_skills);

            $user = User::find($user_id);

            // lấy số lần đã thi của user
            $skills = $user->user_skills()->get();
            $max_code = $this->getMaxCodeTest($skills) + 1;
            $test_id = $user_id . "_" . $max_code;

            $add_user_skill->user_id = $user_id;
            $add_user_skill->level_id = $level_id;
            $add_user_skill->status = 1;
            $add_user_skill->test_id = $test_id;

            $add_user_skill->point = $point;
            $add_user_skill->skill_id = $skill_id;

            $add_user_skill->save();

            Item::where(['user_id' => $user_id, 'level_id' => $level_id, 'skill_id' => $skill_id])->delete();

            return response()->json([
                'code' => 200,
                'data' => $fix_answer_error,
                'message' => 'Bạn đã hoàn thành bài thi với ' . round($point_total, 2) . '/' . $sum_point . ' điểm. '
            ]);
        }

    }

    // hàm kiểm tra đáp án và tính điểm.- KỸ NĂNG READING
    public function checkAnswer($json_answer)
    {
        $check_correct = [];
        $point_total = 0;
        $point = []; // điểm theo từng kỹ năng.

        $point_sum = Config::get('constants.sum_point'); // Tổng điểm của cả bài thi.

        $max_exam = count($json_answer['Read']); // số bài có trong 1 kỹ năng
//        $max_exam = Config::get('constants.max_exam'); // số bài có trong 1 kỹ năng

        foreach ($json_answer as $skill => $items) {
            $point[$skill] = 0;
            foreach ($items as $table => $qts_asn) {
                $total_qts = count($qts_asn); // tổng số câu trong 1 bài ( 1 bài trong 1 kĩ năng)
                $point_each_qts = ($point_sum / $max_exam) / $total_qts;  // điểm trung bình của từng question trong bài đấy.
                $count_correct = 0;
                $count_incorrect = 0;

                $id_record = $qts_asn[0]['id_record'];
                $found_record = DB::table($table)->where(['id' => $id_record])->get()->toArray();
                $answer_correct = json_decode($found_record[0]->content_json);
                $answer_correct_array = [];

                foreach ($answer_correct as $check) {
                    $answer_correct_array[$check->id] = preg_replace('/\s+/', ' ', trim($check->answer));
                }

                foreach ($qts_asn as $item) {
                    $id_question = $item['id_question'];
                    $answer_student = preg_replace('/\s+/', ' ', trim($item['answer_student']));

                    $text_answer_correct = $answer_correct_array[$id_question];
                    if (strcmp($text_answer_correct, $answer_student) == 0) {
//                       $check_correct[$table][$id_record][$id_question] = 1; // đúng kết quả
                        $count_correct++; // số câu đúng

                    } else {
                        // gán kết quả đúng để show cho học sinh.
                        $check_correct[$table][$id_record][$id_question]['answer'] = $text_answer_correct;
//                       $check_correct['review'] = 1;

                        $count_incorrect++; // số câu sai
                    }

                }

                $point[$skill] += $count_correct * $point_each_qts;
            }
            $point_total += $point[$skill];
        }

        return ['check_correct' => $check_correct, 'point' => $point, 'point_total' => $point_total];
    }

    /**
     * XỬ LÍ KỸ NĂNG NGHE
     */

    // hàm hiển thị bài test hoặc bài test chưa hoàn thiện của học sinh - KỸ NĂNG NGHE
    public function redirectToTestListen(Request $request)
    {
        $this->url_parameters = Route::getCurrentRoute()->parameters();

        $skill_code = $this->url_parameters['skill_code'];
        $skill_id = $this->getSkillIdByCode($skill_code);

        $user = Auth::user();
        $user_id = $user->id;

        $class_id = Auth::user()->class_id;
        $levels = $this->levels;

        $skills = $user->user_skills()->where(['skill_id' => $skill_id])->get();
        $max_code = $this->getMaxCodeTest($skills);

        // Lấy kết quả lần thi gần đây nhất.
        $filter_skills = $skills->filter(function ($skill) use ($user_id, $max_code) {
            $test_id = $user_id . '_' . $max_code;

            return $skill->user_id == $user_id && $skill->test_id == $test_id;
        })->all();

        if (!empty($filter_skills)) {
            foreach ($filter_skills as $filter) {
                $get_next_level = $this->checkLevel($filter['point'], $filter['level_id'], 50);
            }
        } else {
            $code_level = 'L2';
            $level = Level::where(['code' => $code_level])->first();
            $get_next_level = $level->id;
        }

        // kiểm tra lượt thi đã tồn tại hay chưa ( được lưu ở bảng Items).
        $check_exist_item = Item::where(['user_id' => $user_id, 'skill_id' => $skill_id])->get();
        if (count($check_exist_item) == 0) {

            $type_exam_read = Config::get('constants.skill.' . $skill_code);
            $random_type_read = array_rand($type_exam_read, 3); // 3
//            $random_type_read = ['listen_ticks'];
//            dd($random_type_read);

            $items = [];

            if (!isset($check_read)) {
//                echo " k ton tai";
                foreach ($random_type_read as $read) {
                    $read_table = DB::table($read)
                        ->where([
                            'class_id' => $class_id,
                            'type_user' => $this->code_student,
                            'level_id' => $get_next_level,
                            'status' => 1
                        ])
                        ->get()->toArray();

                    if (count($read_table) != 0) {
                        $max = count($read_table) - 1;
                        $rand = rand(0, $max);

                        $read_table[$rand]->table = $read;
                        if ($skill_code == 'Read') {
                            $items['Read'][] = $read_table[$rand];
                        } else {
                            $items['Listen'][] = $read_table[$rand];
                        }

                    }
                }

            } else {
                // read chỉ có 1 dạng bài.
                $read_table = DB::table($random_type_read)
                    ->where([
                        'class_id' => $class_id,
                        'type_user' => $this->code_student,
                        'level_id' => $get_next_level
                    ])
                    ->get()->toArray();

                if (count($read_table) != 0) {
                    $max = count($read_table) - 1;
                    $rand = rand(0, $max);

                    $read_table[$rand]->table = $random_type_read;
                    if ($skill_code == 'Read') {
                        $items['Read'][] = $read_table[$rand];
                    } else {
                        $items['Listen'][] = $read_table[$rand];
                    }

                }
            }

            $noti_not_complete = 0;
            $time_remaining = Config::get('constants.time_start');
        } elseif (count($check_exist_item) == 1) { // đã tồn tại

            $noti_not_complete = 1;
//            dd($check_exist_item);
            $items_old = Item::where([
                'user_id' => $user_id,
                'skill_id' => $skill_id,
                'level_id' => $get_next_level
            ])->get();

            $items = [];
            foreach ($items_old as $item) {
                $json_decode_answer = json_decode($item->update_json_answer);
                $time_remaining = $item->time_remaining;
            }

            foreach ($json_decode_answer as $skill => $ans) {
//dd($ans);
                foreach ($ans as $table => $tb) {
//                    dd($tb);
                    $find = DB::table($table)->where([
                        'id' => $tb[0]->id_record
                    ])->first();

                    if ($find == null) {
                        Session::flash('message', 'Không thực hiện được hành động này!');

                        return redirect()->route('frontend.dashboard.student.index');
                    }

                    $find->table = $table;
                    foreach ($tb as $t) {

                        if (!isset($t->id_question)) {
                            $find->old_answer = $t->answer_student;
                        } else {
                            $find->old_answer[$t->id_question] = [
                                'id_question' => $t->id_question,
                                'answer_student' => $t->answer_student
                            ];
                        }
                    }

                    $items[$skill][$tb[0]->order] = $find;
                }
            }

        }
//        dd($items);
        $lamas = $this->lama;

        return view('frontend.student.join-test.listening.index',
            compact('class_id', 'items', 'random_type_listen', 'random_type_read', 'skill_code', 'get_next_level',
                'noti_not_complete', 'time_remaining', 'lamas'));
    }

    // xử lí lưu liên tục kết quả làm bài 15s/lần của học sinh.- KỸ NĂNG NGHE
    public function hanglingResultListen(Request $request)
    {
        $requets_all = $request->all();

        $array_tables = collect($requets_all['list_answer'])->pluck('name_table');
        $table_all = array_unique($array_tables->toArray());

        foreach ($requets_all['list_answer'] as $ans) {
            if ($ans['skill_name'] == 'Listen') {
                foreach ($table_all as $table) {
                    if ($ans['name_table'] == $table) {

                        if (!isset($ans['answer_student'])) {
                            $ans['answer_student'] = '';
                        }

                        if (isset($ans['id_question'])) {
                            $data = [
                                'order' => $ans['number_title'], // số thứ tự của bài đang test. ( bài 1 bài 2)
                                'id_question' => $ans['id_question'],
                                'id_record' => $ans['id_record'],
                                'answer_student' => $ans['answer_student']
                            ];
                        } else {
                            $data = [
                                'order' => $ans['number_title'], // số thứ tự của bài đang test. ( bài 1 bài 2)
                                'id_record' => $ans['id_record'],
                                'answer_student' => $ans['answer_student']
                            ];
                        }

                        $json_answer['Listen'][$table][] = $data;
                    }
                }
            }

        }

        $json_answer_encode = json_encode($json_answer);
        $user_id = Auth::user()->id;
        $level_id = $requets_all['level_id'];
        $time_remaining = $requets_all['time_remaning']; // thời gian còn lại của học sinh để làm bài

        if ($requets_all['submit'] == 1) {
            $done = 1; // học sinh nộp bài
        } else {
            if ($time_remaining == -1) {
                $done = 1; // hết thơi gian làm bài
            } else {
                if ($time_remaining != -1) {
                    $done = 0; // chưa hết tgian và học sinh cũng chưa nộp bài
                }
            }
        }

        $skill_id_item = $this->getSkillIdByCode($ans['skill_name']);

        $check_item_exist = Item::where(['user_id' => $user_id, 'skill_id' => $skill_id_item])->get();
        if ($done == 0) {
            if (count($check_item_exist) == 0) {
                $items = new Item();

                $items->level_id = $level_id;
                $items->skill_id = $skill_id_item;
                $items->user_id = $user_id;
                $items->time_remaining = $time_remaining;
                $items->update_json_answer = $json_answer_encode;

                $items->save();
            } else {
                $data = [
                    'time_remaining' => $time_remaining,
                    'update_json_answer' => $json_answer_encode
                ];

                Item::where([
                    'user_id' => $user_id,
                    'skill_id' => $skill_id_item,
                    'level_id' => $level_id
                ])
                    ->update($data);
            }
        } else {
            // sau khi học sinh nhấn submit hoặc hết tgian
            $sum_point = Config::get('constants.sum_point'); // điểm của mỗi bài trong mỗi kỹ năng
            $add_user_skill = new UserSkill();

            // gọi hàm đối chiếu đáp án & tính điểm
            $result_answer = $this->checkAnswerListen($json_answer);

            $point_skills = $result_answer['point'];
            $point_total = $result_answer['point_total'];

            $fix_answer_error = $result_answer['check_correct'];

            $skill_id = $this->getSkillIdByCode($ans['skill_name']);

            $user = User::find($user_id);

            // lấy số lần đã thi của user
            $skills = $user->user_skills()->get();
            $max_code = $this->getMaxCodeTest($skills) + 1;
            $test_id = $user_id . "_" . $max_code;

            $add_user_skill->user_id = $user_id;
            $add_user_skill->level_id = $level_id;
            $add_user_skill->status = 1;
            $add_user_skill->test_id = $test_id;

            $add_user_skill->point = $point_total;
            $add_user_skill->skill_id = $skill_id;

            $add_user_skill->save();

            Item::where(['user_id' => $user_id, 'level_id' => $level_id, 'skill_id' => $skill_id])->delete();

            return response()->json([
                'code' => 200,
                'data' => $fix_answer_error,
                'message' => 'Bạn đã hoàn thành bài thi với ' . round($point_total, 2) . '/' . $sum_point . ' điểm. '
            ]);
        }

    }

    // hàm kiểm tra đáp án và tính điểm.- KỸ NĂNG NGHE
    public function checkAnswerListen($json_answer)
    {
        $check_correct = [];
        $point_total = 0;
        $point = []; // điểm theo từng kỹ năng.

        $point_sum = Config::get('constants.sum_point'); // Tổng điểm của cả bài thi.
        $max_exam = count($json_answer['Listen']); // số bài có trong 1 kỹ năng

        foreach ($json_answer as $skill => $items) {
            $point[$skill] = 0;
            foreach ($items as $table => $qts_asn) {
                $count_correct = 0;
                $count_incorrect = 0;

                $id_record = $qts_asn[0]['id_record'];
                $found_record = DB::table($table)->where(['id' => $id_record])->get()->toArray();

                $json_decode_answer = json_decode($found_record[0]->content_json); // conten_json từ trong db

                if (isset($json_decode_answer->answer)) { // Dạng bài: Listen Table Tick
                    $answer_correct = $json_decode_answer->answer;
//                    echo 'isset';
                } else {
//                    echo 'konh ton tai';
                    $answer_correct = $json_decode_answer;
                }

                if (isset($json_decode_answer->suggest_choose)) { // Dạng bài: Listen Table Tick
                    $total_qts = count($json_decode_answer->suggest_choose); // tổng số câu trong 1 bài ( 1 bài trong 1 kĩ năng)
                } else {
                    $total_qts = count($qts_asn); // tổng số câu trong 1 bài ( 1 bài trong 1 kĩ năng)
                }

                $point_each_qts = ($point_sum / $max_exam) / $total_qts;  // điểm trung bình của từng question trong bài đấy.

                $answer_correct_array = [];
                foreach ($answer_correct as $key => $check) {
                    if (!isset($check->id)) {
                        $answer_correct_array[$key] = preg_replace('/\s+/', ' ', trim($check));
                    } else {
                        $answer_correct_array[$check->id] = preg_replace('/\s+/', ' ', trim($check->answer));
                    }
                }

                foreach ($qts_asn as $item) {
                    if ($item['id_question'] == 0) {
                        $text_answer_correct = $answer_correct_array;
                    } else {
                        $id_question = $item['id_question'];
                        $text_answer_correct = $answer_correct_array[$id_question];
                    }

                    if (is_array($item['answer_student']) == true) {
                        $answer_student = $item['answer_student'];
                    } else {
                        $answer_student = preg_replace('/\s+/', ' ', trim($item['answer_student']));
                    }

                    $result_check = [];
                    if (is_array($text_answer_correct) == true) { // Dạng bài: Listen Table Tick

                        if (!empty($answer_student)) {
                            $result_check['answer_student_incorrect'] = array_diff($answer_student,
                                $text_answer_correct);
                            $result_check['answer_correct_miss'] = array_diff($text_answer_correct, $answer_student);
                        } else {
                            $result_check['answer_student_incorrect'] = '';
                            $result_check['answer_correct_miss'] = $text_answer_correct;
                        }

                        $check_correct[$table][$id_record]['answer'] = $text_answer_correct;
                        $check_correct[$table][$id_record]['error'] = $result_check['answer_student_incorrect'];

                        $count_incorrect_table_tick = count($result_check['answer_student_incorrect']);
                        $count_correct_table_tick = count($answer_student) - count($result_check['answer_student_incorrect']);
                        $point[$skill] += $point_each_qts * $count_correct_table_tick - $point_each_qts * $count_incorrect_table_tick;

                    } else { // Dạng các dạng bài còn lại
                        if (strcmp($text_answer_correct, $answer_student) == 0) {
//                       $check_correct[$table][$id_record][$id_question] = 1; // đúng kết quả
                            $count_correct++; // số câu đúng

                        } else {
                            // gán kết quả đúng để show cho học sinh.
                            if (!isset($id_question)) {
                                $id_question = 1;
                                $check_correct[$table][$id_record][$id_question]['answer'] = $text_answer_correct;
                            } else {
                                $check_correct[$table][$id_record][$id_question]['answer'] = $text_answer_correct;
//                                echo "khong ton tai";
                            }
                            $count_incorrect++; // số câu sai
                        }
                    }
                }

                $point[$skill] += $count_correct * $point_each_qts;
            }

            $point_total += $point[$skill];
        }

        return ['check_correct' => $check_correct, 'point' => $point, 'point_total' => $point_total];
    }

    /**
     * XỬ LÍ ITEMS
     */

    // xoas 1 item trong bang Items
    public function deleteItems($check_item_exist)
    {
        $check_item_exist->delete();
    }

    // xoas 1 item trong bang Items khi ajax goi restart.
    public function restartDeleteItem(Request $request)
    {
        $request_all = $request->all();
        $skill_id = $this->getSkillIdByCode($request_all['skill_code']);
        $check_item_exist = Item::where(['user_id' => Auth::user()->id, 'skill_id' => $skill_id]);

        if (count($check_item_exist) == 0) {
            return response()->json([
                'code' => 404,
                'message' => 'Bài làm trước đó chưa tồn tại!',
            ]);
        }

        $check_item_exist->delete();

        if ($check_item_exist == true) {
            return response()->json([
                'code' => 200,
                'message' => '',
            ]);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'Không thực hiện được hành động này!',
            ]);
        }
    }

    // lấy lượt thi gần đây nhất của học sinh.
    public function getMaxCodeTest($skills)
    {
        $all_code_test = [];
        $max_code = 1;
        foreach ($skills as $key => $skill) {
            $test_id = $skill->test_id;
            $max_test_id = explode('_', $test_id);
            $all_code_test[] = $max_test_id[1];
            $max_code = max($all_code_test);
        }

        return $max_code;
    }

    // tạo code ( test_id) cho lượt thi của học sinh
    public function create_code_test_id($max_code, $user_id)
    {
        $code = $user_id . "_" . $max_code;

        return $code;
    }

    public function show_results()
    {
        $user_id = Auth::user()->id;
        $all_results = [];

        $results = UserSkill::where(['user_id' => $user_id])->get();

        foreach ($results as $result) {
            $max_test_id = explode('_', $result->test_id);
            $result->test_id = $max_test_id[1];
            $result->point = $result->point;
            $result->level_id = $result->level_id;
        }


        $all_results['Read'] = $results->filter(function ($result) {
            return $result->skill_id == $this->getSkillIdByCode('Read');
        });

        $all_results['Listen'] = $results->filter(function ($result) {
            return $result->skill_id == $this->getSkillIdByCode('Listen');
        });

        $all_results['Speak'] = $results->filter(function ($result) {
            return $result->skill_id == $this->getSkillIdByCode('Speak');
        });

        return view('frontend.student.test_results', compact('all_results'));
    }

    public function getSkillIdByCode($code_skill)
    {
        $skill = Skill::where(['code' => $code_skill])->first();

        return $skill->id;
    }

    public function profile()
    {
        $user = Auth::user();
        $classes = Classes::all();

        return view('frontend.student.profile', compact('user', 'classes'));
    }

    public function change_avatar(Request $request, $user_id)
    {
        $user = User::where(['id' => $user_id])->first();
        $classes = Classes::all();

        $data = $request->all();

        if (isset($data['change_avatar'])) {
            $file_cover = Input::file('change_avatar');
            $destinationPath_cover = public_path('img/img-avatar'); // upload path
            $extension_cover = $file_cover->getClientOriginalExtension(); // getting image extension
            $filename_cover = $user->id . '-avatar' . '.' . $extension_cover;
            $file_cover->move($destinationPath_cover, $filename_cover);
            $convert_save['avatar'] = "img/img-avatar/" . $filename_cover;

            DB::table('users')
                ->where('id', $user_id)
                ->update($convert_save);

            Session::flash('message', 'To change your avatar successful!');
        } else {
            Session::flash('message', 'No change!');
        }

        return Redirect()->route('frontend.student.show.profile', ['user' => $user, 'classes' => $classes]);
    }

    public function change_infomation(Request $request, $user_id)
    {
        $user = User::where(['id' => $user_id])->first();
        $classes = Classes::all();

        $data = $request->all();
        if (!isset($data['change_class'])) {
            $data['change_class'] = null;
        }

        if ($user->user_name == $data['change_user_name'] && $user->full_name == $data['change_full_name'] && $user->email == $data['change_email'] && $user->class_id == $data['change_class']) {
            Session::flash('message', 'No change!');
        } else {

            $change_data = [
                'user_name' => $data['change_user_name'],
                'full_name' => $data['change_full_name'],
                'email' => $data['change_email'],
                'class_id' => $data['change_class'],
            ];

            DB::table('users')
                ->where('id', $user_id)
                ->update($change_data);

            Session::flash('message', 'To change your information successful!');
        }

        return Redirect()->route('frontend.student.show.profile', ['user' => $user, 'classes' => $classes]);
    }

}
