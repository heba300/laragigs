<?php

namespace App\Repositories\Auth\UserRepository;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Repositories\BaseElqouentRepository;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Repositories\Auth\ForgetPasswordInterface;

class ElqouentForgetRepository extends BaseElqouentRepository implements ForgetPasswordInterface
{
    public function insertDate(ForgetPasswordRequest $request)
    {
        $request->except('_token');

        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        return $token;
    }

    public function sendPassword(ForgetPasswordRequest $request)
    {
        $token = $this->insertDate($request);
        Mail::send("email.forget-password", ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('reset password');
        });
    }

    public function updatePassword(ResetPasswordRequest $request)
    {
        $request->except('_token');
        return DB::table('password_reset_tokens')
            ->where([
                "email" => $request->email,
                "token" => $request->token
            ])->first();
    }
    public function checkPassword(ResetPasswordRequest $request)
    {
        $updatePassword = $this->updatePassword($request);
        if ($updatePassword) {
            User::where("email", $request->email)->update(["password" => Hash::make($request->password)]);

            DB::table('password_reset_tokens')->where(["email" => $request->email])->delete();
            return true;
        }
        return false;
    }
}
