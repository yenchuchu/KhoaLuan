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
        return view('dashboard.test_design');
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

    public function secondary()
    {

        return view('frontend.secondary.index');
    }

    public function highschool()
    {

        return view('frontend.highschool.index');
    }


}
