<?php

namespace App\Http\Controllers\backend\author\teacher_use;

use App\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Level;
use App\AnswerQuestion;
use App\AnswerQuestionDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class ExamForTeacherController extends Controller
{

    public function index()
    {
        $ans_questions_all = AnswerQuestion::orderBy('level_id', 'ASC')
            ->with('skills', 'levels')
            ->get();

        $ans_questions = [];
        foreach ($ans_questions_all as $ans) {
//            $ans->created_at = $ans->created_at->format('d-m-Y');
//            $ans->updated_at = $ans->updated_at->format('d-m-Y');
            $ans->content_json = json_decode($ans->content_json);
            $ans->skills = $ans->skills->first();
            $ans->levels = $ans->levels->first();

            $ans_questions[] = $ans;

        }

        return view('backend.author.answer_question.index', compact('ans_questions'));
    }

    public function createExamUsullay()
    {
        return view('backend.author.teacher_use.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all_data = $request->all();

        $skill = Skill::where('code', $this->skill)->first();
        $level_id = $all_data['level_id'];

        foreach ($all_data['answer_question'] as $data) {

            $answer_question_content_question = $data['content-choose-ans-question'];
            $answer_question = new AnswerQuestion();

            $answer_question->title = $data['title-answer-question'];
            $answer_question->content = $data['content-answer-question'];
            $answer_question->point = $data['point'];
            $answer_question->content_json = json_encode($answer_question_content_question);
            $answer_question->skill_id = $skill->id;
            $answer_question->level_id = $level_id;

            $answer_question->save();

//            $answer_question_details = new AnswerQuestionDetail();
//
//            $answer_question_content_question = $data['content-choose-ans-question'];
//            $answer_question_id = $answer_question->id;
//
//            $answer_question_details->answer_question_id = $answer_question_id;
////            $answer_question_details->title = $answer_question_id;
//            $answer_question_details->content_json = json_encode($answer_question_content_question);
//
//            $answer_question_details->save();
        }

        return Redirect()->route('backend.manager.author.answer-question');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
