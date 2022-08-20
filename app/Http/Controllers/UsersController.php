<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public static function index()
    {
        if(Auth::user()->privilege_id == 2) {
            $users = User::all();
            return view('sections.users.index', [
                'users' => $users]
            );
        } else {
            return redirect()->route('lists');
        }
    }

    protected function create(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User;
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->privilege_id = 0;
        $user->save();
        return redirect('/users');
    }
}
