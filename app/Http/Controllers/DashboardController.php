<?php

namespace App\Http\Controllers;

use App\Classes;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    public function index()
    {
        $classes = Classes::all();
//        dd(Config::get('language'));
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

    public function switchLang($lang)
    {
        if (array_key_exists($lang, Config::get('language'))) {
            Session::set('applocale', $lang);
        }
        return Redirect::back();
    }

}
