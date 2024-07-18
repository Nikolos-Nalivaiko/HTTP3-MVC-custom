<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;

class CredentionalsVerificationService
{
    public User $userModel;

    public function __construct()
    {
        $this->userModel = new User();    
    }

    public function verifyLogin(string $login): array|bool
    {
        $user = $this->userModel->getUserByLogin($login);

        if($user)
        {
            return $user;
        }

        return false;
    }
    
    public function verifyPassword(string $password, string $login) :bool
    {
        $user = $this->verifyLogin($login);

        if(!empty($user) && password_verify($password, $user['password']))
        {
            return true;
        } 

        return false;
    }
}