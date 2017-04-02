<?php

namespace App\Http\Controllers\frontend;

use App\BookMap;
use App\Classes;
use App\ExamType;
use App\Http\Controllers\Controller;
use App\Skill;
use Config;
use DB;
use Illuminate\Http\Request;

//use Barryvdh\DomPDF\PDF;

class TeacherController extends Controller
{

    protected $classes;
    protected $exam_type;
    protected $skills;
    protected $book_maps;
    protected $kind_exam;

    public function __construct()
    {
        $this->classes = Classes::all();
        $this->exam_type = ExamType::all();
        $this->skills = Skill::all();
        $this->book_maps = BookMap::all();

        $this->kind_exam = Config::get('constants.skill');
        $this->lama = Config::get('constants.lama');
    }

    public function index()
    {
        $classes = Classes::all();
//        dd($classes);
        return view('dashboard.index');
    }

    public function elementary()
    {
        $classes = $this->classes->filter(function ($class, $key) {
            return $class->code == 1;
        });
        $exam_types = $this->exam_type;
        $skills = $this->skills;
        $book_maps = [];
        $kind_exam = $this->kind_exam;

        return view('frontend.teachers.elementary.index',
            compact('classes', 'exam_types', 'skills', 'book_maps', 'kind_exam'));
    }

    public function get_unit_class(Request $requests)
    {
        $all_request = $requests->all();
        $class_id = $all_request['class_id'];

        $book_maps = BookMap::where('class_id', $class_id)->get();

        return view('frontend.teachers.elementary.unit-reload', compact('book_maps'));
    }

    public function get_examtype_skill(Request $requests)
    {
        $all_request = $requests->all();
        $skill_code = $all_request['skill_code'];
        $examtype_skills = $this->kind_exam[$skill_code];

        return view('frontend.teachers.elementary.examtype-skill-reload', compact('examtype_skills'));
    }

    public function store(Request $request)
    {
        $request_all = $request->all();

        $class_id = $request_all['class_id'];
        $exam_type_id = $request_all['exam_type_id'];
        $find_exam_type = ExamType::whereId($exam_type_id)->first();
        if (!isset($find_exam_type)) {
            Session::flash('message', 'Không thực hiện được hành động này.');

            return view('dashboard.index');
        }

        $code_user = $request_all['code_user'];

        if (!isset($request_all['skill_id']) || $request_all['skill_id'] == 0) {
            $skill_id = null;
            $code_skill = '';
        } else {
            $skill_id = $request_all['skill_id'];
            $find_skill = Skill::find($skill_id);
            $code_skill = $find_skill->code;
        }

//        $examtype_skills = [];
        if (isset($request_all['examtype_skills'])) {
            $examtype_skills = $request_all['examtype_skills'];
        } else {

            $type_exam_read = Config::get('constants.skill.Read');
            $random_type_read = array_rand($type_exam_read, 3);

            $type_exam_listen = Config::get('constants.skill.Listen');
            $random_type_listen = array_rand($type_exam_listen, 1);

//            $examtype_skills
        }


        if (!isset($request_all['book_map_id'])) {
            $book_map_id = null;
        } else {
            $book_map_id = $request_all['book_map_id'];
        }

        $record_model = [];
        foreach ($examtype_skills as $item) {

            $records[$item] = DB::table($item)->where([
                'class_id' => $class_id,
                'type_user' => $code_user,
                'skill_id' => $skill_id,
                'exam_type_id' => $exam_type_id
            ])
                ->whereIn('bookmap_id', $book_map_id)
                ->get();

            $number_random = rand(0, count($records[$item]) - 1);
//            foreach ($records[$item] as $order => $record) {

            $records[$item][$number_random]->content_json = json_decode($records[$item][$number_random]->content_json);
            $records[$item][$number_random]->type_model = $item;
//            }

            $record_model[$item] = $records[$item][$number_random];
        }
//        dd($record_model);

        $lamas = $this->lama;

        return view('frontend.teachers.elementary.show', compact('record_model', 'code_skill', 'find_exam_type', 'lamas'));
//        $pdf = PDF::loadView('frontend.teachers.elementary.show', compact('record_model', 'code_skill'))->setPaper('a4', 'portrait');
//        return $pdf->stream();
//        return $pdf->download('invoice.pdf');
    }

    public function secondary()
    {
        $classes = $this->classes->filter(function ($class, $key) {
            return $class->code == 2;
        });
        $exam_types = $this->exam_type;
        $skills = $this->skills;
        $book_maps = $this->book_maps;

        return view('frontend.teachers.secondary.index', compact('classes', 'exam_types', 'skills', 'book_maps'));
    }

    public function highschool()
    {
        $classes = $this->classes->filter(function ($class, $key) {
            return $class->code == 3;
        });
        $exam_types = $this->exam_type;
        $skills = $this->skills;
        $book_maps = $this->book_maps;

        return view('frontend.teachers.highschool.index', compact('classes', 'exam_types', 'skills', 'book_maps'));
    }

}
