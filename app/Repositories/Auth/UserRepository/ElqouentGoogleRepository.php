<?php

namespace App\Repositories\Auth\UserRepository;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Repositories\BaseElqouentRepository;
use App\Repositories\Auth\GoogleRepositoryInterface;

class ElqouentGoogleRepository extends BaseElqouentRepository implements GoogleRepositoryInterface
{


    public function getGoogleUser()

    {
        return Socialite::driver('google')->user();
    }

    public function getMailUser($google_user)
    {
        return User::where('email', $google_user->getEmail())->first();
    }

    public function createUser()
    {
        $google_user = $this->getGoogleUser();

        return User::create([
            'name' => $google_user->getName(),
            'email' => $google_user->getEmail(),
            'google_id' => $google_user->getId()
        ]);
    }

    public function logInUser()
    {
        $google_user = $this->getGoogleUser();
        $user = $this->getMailUser($google_user);
        if (!$user) {

            Auth::login($this->createUser());
            return true;
        } else {
            Auth::login($user);
            return false;
        }
    }
}
