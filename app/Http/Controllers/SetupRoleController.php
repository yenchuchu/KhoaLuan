<?php

namespace App\Http\Controllers;

use App\Classes;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;

class SetupRoleController extends Controller
{
    public function setupRole()
    {
        $classes = Classes::all();
        return view('dashboard.check-role-facebook', compact('classes'));
    }

    public function postSetupRole(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        if (!isset($data['class']) || $data['class'] == 0) {
            $data['class'] = null;
        }

        $roles = Role::where('code', $data['office_type'])->first();

        User::where([
            'id' => $user->id,
            'email' => $user->email])
            ->update([
                'class_id' => $data['class'],
                'type' => $roles->id,
            ]);

        $user->roles()->attach($roles->id);

        if ( $user->hasRole('ST')) {
            return redirect()->route('frontend.dashboard.student.index');
        }

        if ( $user->hasRole('AD')) {
            return redirect()->route('backend.manager.users.index');
        }

        if ( $user->hasRole('AT')) {
            return redirect()->route('backend.manager.author.index');
        }
    }
}
