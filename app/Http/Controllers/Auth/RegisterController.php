<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Classes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/dashboard';
    protected  $classes ;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->classes = Classes::all();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
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
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        if(!isset($data['class'])) {
            $data['class'] = null;
        }

        $roles = Role::where('code', $data['office_type'])->first();

        return User::create([
            'full_name' => $data['full_name'],
            'type' => $roles->id,
            'email' => $data['email'],
            'class_id' => $data['class'],
            'user_name' => $data['user_name'],
            'password' => bcrypt($data['password']),
            'avatar' => 'imgs-dashboard/avatar.png',
        ]);


    }
}
