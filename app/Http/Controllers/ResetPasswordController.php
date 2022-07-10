<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Notifications\ResetPasswordRequest;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    public function sendMail(Request $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' => Str::random(60),
        ]);
        if ($passwordReset) {
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }
  
        return response()->json([
        'message' => 'We have e-mailed your password reset link!'
        ]);
    }

    public function reset(Request $request, $token)
    {
        // $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        // if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
        //     Carbon::now();
        //     $passwordReset->delete();

        //     return response()->json([
        //         'message' => 'This password reset token is invalid.',
        //     ], 422);
        // }
        // $user = User::where('email', $passwordReset->email)->firstOrFail();
        // $updatePasswordUser = $user->update($request->only('password'));
        // $passwordReset->delete();

        // return response()->json([
        //     'success' => $updatePasswordUser,
        // ]);
    }

    public function index()
    {   
        return view('forgotpassword');
    }

    public function forgotHandler(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users,email',
        ],[
            'email.exists'=>"Email does not exist"
        ]);
        $token=base64_encode(Str::random(64));
        $passreset= new PasswordReset();
        $passreset->fill([
            'email'=>$request->email,
            'token'=>$token,
        ]);
        $passreset->save();
        $user=User::where('email','=',$request->email)->first();
        // return $user;   
        $link=route('resetpassword',['token'=>$token,'email'=>$request->email]);
        // $body_message="We are received a request to reset the password for <b>Perfume Shop</b> account associated with ".$request->email."<br> You can reset your password by clicking the button below.";
        // $body_message.='<br>';
        // $body_message.='<a href="'.$link.'" target="_blank" style="color:#FFF;border-color:#22bc66;border-style:solid;border-width:10px 180px;
        // background-color:#22bc66; display:inline-block;text-decoration:none;border-radius:3px;box-shadow:0 2px 3px rgba(0,0,0,16);-webkit-text-size-adjust:none
        // box-sixing:border-box">Reset Password</a>';
        // $body_message.='<br>';
        // $body_message.='If you did not request for a password reset, please ignore this email.';
        // // $data=array(
        //     'name'=>$user->username,
        //     'body_message'=>$body_message
        // );
        // return $data[0];
        $body="We are received a request to reset the password for <b>Perfume Shop</b> account associated with ".$request->email."<br> You can reset your password by clicking the button below.";;
        Mail::send('forgot-mail-template',['link'=>$link,'body_message'=>$body,'name'=>$user->username],function($message)use($user){
            $message->from('nonreply@example.com','Perfume Shop');
            $message->to($user->email,$user->name)
            ->subject('Reset Password');
        });
        // Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
        //     $m->from('hello@app.com', 'Your Application');
 
        //     $m->to($user->email, $user->name)->subject('Your Reminder!');
        // });
        return Redirect()->back()->withErrors(['success' => 'We have e-mailed your password reset link.']);

    }
    public function resetpassword(Request $request, $token=null)
    {   
        return view('resetpassword')->with(['token'=>$token,'email'=>$request->email]);
    }

    public function resetHandler(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'bail|required|between:5,20|confirmed',
        ]);
        $checktoken=PasswordReset::where('email','=',$request->email)->where('token','=',$request->token)->first();
        if(!$checktoken){
            return Redirect()->back()->withErrors(['fail' => 'Invalid token.']);
        }else{
            $user=User::where('email','=',$request->email)->first();
            $user->password=bcrypt($request->password);
            $user->save();
            $pass=PasswordReset::where('email','=',$request->email)->first();
            $pass->delete();
            return Redirect()->back()->withErrors(['success' => 'Your pasword has been updated successfully. Login with your email '.$request->email.' and your new password']);
        }
    }
}
