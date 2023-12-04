<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Http\Requests\Auth\AuthRequest;
use App\Repositories\Auth\UserRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        return $this->userRepository = $userRepository;
    }

    public function create()
    {
        return view('users.register');
    }

    public function store(AuthRequest $request)
    {
        $this->userRepository->createAuth($request);
        return redirect('/')->with('message', 'User Create And Login');
    }

    public function logout(Request $request)
    {
        $this->userRepository->logoutAuth($request);
        return redirect('/')->with('message', 'you Have Been Logout!');
    }

    public function login()
    {
        return view('users.login');
    }

    public function authenticate(AuthenticateRequest $request)
    {

        if ($this->userRepository->authenticateAuth($request)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'you are now login');
        }
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
