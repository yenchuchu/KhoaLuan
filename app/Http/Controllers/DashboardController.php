<?php

namespace App\Http\Controllers;

use App\Classes;
use Illuminate\Http\Request;
use App\User;
use Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $classes = Classes::all();
//        dd($classes);
        return view('dashboard.index');
    }

    public function dashboardDesign()
    {
        $classes = Classes::all();

        return view('dashboard.test_design');
    }

    public function redirectUrl() {
        $roles = Auth::user()->roles()->first();
//dd(Auth::user()->hasRole('AD'));
        if (count($roles) === 1) {
            if ( Auth::user()->hasRole('TC')) {
                return redirect()->route('frontend.teacher.index');
            }

            if ( Auth::user()->hasRole('ST')) {
                return redirect()->route('frontend.dashboard.student.index');
            }

            if ( Auth::user()->hasRole('AD')) {
                return redirect()->route('backend.manager.users.index');
            }

            if ( Auth::user()->hasRole('AT')) {
                return redirect()->route('backend.manager.author.index');
            }
        }

//        if (Auth::user()->hasRole('AD') || Auth::user()->hasRole('SA') || Auth::user()->hasRole('CRM') || Auth::user()->hasRole('SAM')) {
//            return view('pages.dashboard');
//        } else {
//
//            if (Auth::user()->hasRole('SM')) {
//                $schools = Auth::user()->schools->sortByDesc('id');
//                if (count($schools) == 1) {
//                    return redirect('/school/' . $schools[0]->id);
//                }
//
//                return redirect('/school');
//            } else {
//                $school = Auth::user()->school_staff()->first();
//                Session::put('school_id', $school->id);
//                if (Auth::user()->hasRole('TC')) {
//                    return redirect(route('get.v2.dashboard.teachers'));
//                    $school_year = new SchoolYear();
//                    $c = Auth::user()->teacher_get_class_inCurrentYear();
//                    if ($c == null) {
//                        // return ("Hiện tại tài khoản giáo viên này chưa được phân lớp trong năm học hiện tại");
//                        return redirect('school/' . $school->id)->with('school',
//                            $school)->withErrors("Hiện tại tài khoản giáo viên này chưa được phân lớp trong năm học hiện tại");
//                    } else {
//                        $class = Classes::findOrFail($c->id);
//                        Session::put('class_id', $class->id);
//
//                        $now = Carbon::today();
//
//                        $absents = AbsentRequest::where('class_id', '=', $class->id)
//                            ->where('from_date', '<=', $now)
//                            ->where('to_date', '>=', $now)
//                            ->where('status', '=', 1)
//                            ->get();
//                        $medicineNotes = MedicineNote::where('class_id', '=', $class->id)
//                            ->where('from_date', '<=', $now)
//                            ->where('to_date', '>=', $now)
//                            ->where('status', '=', 1)
//                            ->get();
//
//                        $absent_request_notification = Notification::where('user_id', '=', Auth::user()->id)
//                            ->where('type', '=', 'AB')
//                            ->where('date', '=', Carbon::today())
//                            ->first();
//                        if (count($absent_request_notification) == 0) {
//                            Session::put('checked_absent_requests', '0');
//                            Session::put('count_absent_requests', count($absents));
//                        } else {
//                            Session::put('checked_absent_requests', '1');
//                        }
//
//                        $medicine_note_notification = Notification::where('user_id', '=', Auth::user()->id)
//                            ->where('type', '=', 'MN')
//                            ->where('date', '=', Carbon::today())
//                            ->first();
//                        if (count($medicine_note_notification) == 0) {
//                            Session::put('checked_medicine_notes', '0');
//                            Session::put('count_medicine_notes', count($medicineNotes));
//                        }
//                        Session::put('teacher', 'TC');
//
////					dd(count($medicine_note_notification),count($absent_request_notification),count($absents),count($medicineNotes));
//                        return view('pages.dashboard', compact('school', 'class', 'absents', 'medicineNotes'));
//                        // return view('pages.dashboard', compact('school', 'class'));
//                    }
//                } else {
//                    if (Auth::user()->hasRole('CS')) {
//                        return view('pages.dashboard', compact('school'));
//                    }
//                }
//
//                // return view('pages.dashboard', compact('school'));
//                return redirect('school/' . $school->id)->with('school', $school);
//            }
//        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function elementary()
    {

        return view('frontend.elementary.index');
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


}
