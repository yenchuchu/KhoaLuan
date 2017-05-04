<?php

namespace App\Http\Controllers\Auth;

use App\Classes;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/redirect_login';
    protected $classes;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->classes = Classes::all();
//        dd($this->classes);
    }

    public function showRegistrationFormReset()
    {
//        dd();
        $classes = Classes::all();
        return view('auth.register', compact('classes'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'full_name' => 'required|max:255',
            'user_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        if (!isset($data['class']) || $data['office_type'] == 'AT') {
            $data['class'] = null;
        }

        $roles = Role::where('code', $data['office_type'])->first();

        $user = new User();
        $user->full_name = $data['full_name'];
        $user->type = $roles->id;
        $user->email = $data['email'];
        $user->number_phone = null;
        $user->class_id = $data['class'];
        $user->user_name = $data['user_name'];
        $user->password = bcrypt($data['password']);
        $user->avatar = 'imgs-dashboard/avatar.png';

        $user->save();

        $user->roles()->attach($roles->id);
        return $user;


    }
}
