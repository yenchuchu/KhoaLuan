<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Route;

class AuthorController extends Controller
{

    protected $posts;
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.author.index');
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

        return view('backend.author.grade-menu',compact('class_code', 'name_code'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user_id = $request->all();
        $user = User::whereId($user_id)->with('roles')->first();

        if(count($user) != 1) {
            return response()->json([
                'code' => 404,
                'message' => 'Không tìm thấy người dùng!',
            ]);
        }
        $roles = $user->roles()->get();

        if(!isset($roles)) {
            return response()->json([
                'code' => 404,
                'message' => 'Không thực hiện được hành động này!',
            ]);
        }

        $roles_ids = [];
        foreach ($roles as $rol) {
            $roles_ids[] = $rol->id;
        }

        $user->roles()->detach($roles_ids);
        $user->delete();

        $users = User::with('roles', 'classes')->get();
        return view('backend.users.table-index', compact('users'));

    }
}
