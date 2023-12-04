<?php

namespace App\Repositories\Auth\UserRepository;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\AuthRequest;
use App\Repositories\BaseElqouentRepository;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Repositories\Auth\UserRepositoryInterface;

class ElqouentUserRepository extends BaseElqouentRepository implements UserRepositoryInterface
{
    public function createAuth(AuthRequest $request)
    {

        $formFields = $request->except('_token');
        $formFields['password'] = bcrypt($formFields['password']);
        return auth()->login($this->create($formFields));
    }

    public function logoutAuth(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function authenticateAuth(AuthenticateRequest $request)
    {
        $formFields = $request->except('_token');
        return auth()->attempt($formFields);
    }
}
