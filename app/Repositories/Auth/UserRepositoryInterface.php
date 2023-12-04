<?php

namespace App\Repositories\Auth;

use App\Http\Requests\Auth\AuthenticateRequest;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Http\Requests\Auth\AuthRequest;


interface UserRepositoryInterface extends BaseRepository
{
    public function createAuth(AuthRequest $request);
    public function logoutAuth(Request $request);
    public function authenticateAuth(AuthenticateRequest $request);
}
