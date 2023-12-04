<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Repositories\Auth\GoogleRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleAuthController extends Controller
{
    private $googleRepository;
    public function __construct(GoogleRepositoryInterface $googleRepository)
    {
        return $this->googleRepository = $googleRepository;
    }
    public function redirect()
    {
        //composer require laravel/socialite terminal
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $this->googleRepository->logInUser();
            return redirect()->intended('/');
        } catch (Exception $d) {
            dd('something wrong', $d->getMessage());
        }
    }
}
