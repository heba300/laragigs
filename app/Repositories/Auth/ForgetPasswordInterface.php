<?php

namespace App\Repositories\Auth;

use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Repositories\BaseRepository;

interface ForgetPasswordInterface extends BaseRepository
{
    public function insertDate(ForgetPasswordRequest $request);
    public function sendPassword(ForgetPasswordRequest $request);
    public function updatePassword(ResetPasswordRequest $request);
    public function checkPassword(ResetPasswordRequest $request);
}
