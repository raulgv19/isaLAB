<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:email',
            'password' => 'required',
        ]);

        $user = User::create($data);

        //return redirect('/users')->with([ 'message' => 'Usuario creado correctamente', 'message_type' => MESSAGE_SUCCESS ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $user->fill($request->all())->save();

        return redirect()->back();
        //return redirect('/users')->with([ 'message' => 'Usuario creado correctamente', 'message_type' => MESSAGE_SUCCESS ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        //return redirect('/users')->with([ 'message' => 'Usuario creado correctamente', 'message_type' => MESSAGE_SUCCESS ]);
    }
}
