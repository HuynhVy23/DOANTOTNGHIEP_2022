<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function fixImage(User $user){
        $user->avatar=Storage::url($user->avatar);
    }
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
            'username'=>'bail|required|alpha_dash|between:4,50|unique:users,username',
            'email'=>'bail|required|email|unique:users,email',
            'password'=>'bail|required|between:5,20|confirmed',
            'address'=>'required|alpha_dash',
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
           }else{
            $user->avatar = 'img/user/auto.jpg';
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        $this->fixImage($user);
        return view('infouser',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'address'=>'required|alpha_dash',
            'phone'=>'bail|required|numeric|digits:10'
        ]);

        $user=User::find($id);
        if($request->hasFile('avatar')){
            $user->avatar=$request->file('avatar')->store('img/user/'.$user->id,'public');
        }
        $user->fill([
            'address'=>$request->input('address'),
            'birthday'=>$request->input('birthday'),
            'phone'=>$request->input('phone'),
            'gender'=>$request->input('gender'),
        ]);
        $user->save();
        $this->fixImage($user);
        return view('infouser',['user'=>$user,'success'=>1]);
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
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended('/');
        }
        elseif (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email'));
    }

    public function showchangePass()
    {
        return view('changepass');
    }

    public function changePass(Request $request,$id)
    {
        $user=User::find($id);
        $request->request->add(['password_old' => $user->password]);
        $this->validate($request, [
            'password' => 'required|same:password_old',
            'newpassword'=>'bail|required|between:5,20|confirmed',
        ]);

        $user->password=bcrypt($request->input('newpassword'));
        $user->save();
        return route('changepass',['success'=>1]);
    }

}
