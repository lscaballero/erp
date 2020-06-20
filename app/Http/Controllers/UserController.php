<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function config()
    {
        return view('user.config');
    }

    public function update(Request $request)
    {
        $id = \Auth::user()->id;
        $user = \Auth::user();

        //valdiar datos
        $valdiate = $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
        ]);

        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');

        $user->name = $name;
        $user->surname = $surname;
        $user->email = $email;

        $user->update();

        return redirect()->route('config')->with(['message' => 'Usuario actualizado']);
    }


}
