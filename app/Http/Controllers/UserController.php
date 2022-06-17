<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username'=>'bail|required|alpha_dash|between:5,50',
            'email'=>'bail|required|email',
            'password'=>'bail|required|between:5,20|confirmed',
            'address'=>'required',
            'phone'=>'bail|required|numeric|digits:10'
        ]);
            $user=new User();
            $user->fill([
               'username'=>$request->input('username'),
               'email'=>$request->input('email'),
               'password'=>bcrypt($request->input('password')),
               'address'=>$request->input('address'),
               'birthday'=>$request->input('birthday'),
               'phone'=>$request->input('phone'),
               'gender'=>$request->input('gender'),
               'avatar'=>'',
            ]);
            $user->save();
            if ($request->hasFile('avatar')) {
               $user->avatar = $request->file('avatar')->store('img/user/' . $user->id, 'public');
           }
           $user->save();
           return view('register',['success'=>1]);
        
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(User $user)
    {
        
    }
}
