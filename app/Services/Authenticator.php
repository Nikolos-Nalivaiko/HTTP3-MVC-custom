<?php

namespace App\Services;

use App\Models\User;

class Authenticator
{
    protected $userModel;

    public function checkCredentials(User $userModel, $password, $login)
    {
        $user = $userModel->getUserByLogin($login);
        
        if($user && password_verify($password, $user['password']))
        {
            return false;
        }

        return true;
    }
}