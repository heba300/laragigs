<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use App\Repositories\Auth\ForgetPasswordInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class forgetPasswordController extends Controller
{
    private $forgetPasswordRepository;


    public function __construct(ForgetPasswordInterface $forgetPasswordRepository)
    {
        return $this->forgetPasswordRepository = $forgetPasswordRepository;
    }
    public function forgetPassword()
    {
        return view("users.forget-password");
    }


    public function forgetPasswordPost(ForgetPasswordRequest $request)
    {
        $this->forgetPasswordRepository->sendPassword($request);
        return redirect()->to(route("forgetPassword"))->with('success', 'we have send an email to reset password');
    }


    public function resatPassword($token)
    {
        return view('users.new-password', compact('token'));
    }

    public function resatPasswordPost(ResetPasswordRequest $request)
    {
        $updatePassword = $this->forgetPasswordRepository->checkPassword($request);

        if ($updatePassword == false) {
            return redirect()->to(route("resatPassword"))->with('error', 'Invalidate');
        }

        return redirect()->to(route("login"))->with('success', 'password reset success');
    }
}
