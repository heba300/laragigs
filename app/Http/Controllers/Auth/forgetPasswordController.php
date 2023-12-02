<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class forgetPasswordController extends Controller
{
    public function forgetPassword()
    {
        return view("users.forget-password");
    }


    public function forgetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => "required|email|exists:users",
        ]);
        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        Mail::send("email.forget-password", ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('reset password');
        });
        return redirect()->to(route("forgetPassword"))->with('success', 'we have send an email to reset password');
    }

    public function resatPassword($token)
    {
        return view('users.new-password', compact('token'));
    }

    public function resatPasswordPost(Request $request)
    {
        $request->validate([
            'email' => "required|email|exists:users",
            'password' => "required|string|min:6|confirmed",
            'password_confirmation' => "required",
        ]);
        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                "email" => $request->email,
                "token" => $request->token
            ])->first();
        if (!$updatePassword) {
            return redirect()->to(route("resatPassword"))->with('error', 'Invalidate');
        }

        User::where("email", $request->email)->update(["password" => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(["email" => $request->email])->delete();

        return redirect()->to(route("login"))->with('success', 'password reset success');
    }
}
