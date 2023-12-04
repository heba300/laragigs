<?php

namespace App\Repositories\Auth;

use App\Repositories\BaseRepository;

interface GoogleRepositoryInterface extends BaseRepository

{
    public function getGoogleUser();
    public function getMailUser($google_user);
    public function createUser();
    public function logInUser();
}
