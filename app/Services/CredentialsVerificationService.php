<?php

declare(strict_types=1);

namespace App\Services;

use Core\Models\User;
use App\Services\HasherService;

class CredentialsVerificationService
{
    public User $userModel;
    public HasherService $hash;

    public function __construct()
    {
        $this->userModel = new User();
        $this->hash = new HasherService();    
    }

    public function verifyLogin(string $login): array|bool
    {
        $user = $this->userModel->getUserByLogin($login);

        if($user)
        {
            return [
                'user' => $user,
                'status' => true
            ];
        }

        return ['status' => false];
    }

    public function verifyPassword(string $password, string $login) :bool
    {
        $user = $this->verifyLogin($login);
        
        if($user['status'] == true) {
            $user = $user['user'];
        } else {
            return false;
        }

        if(!empty($user)) {
            $decryptedPassword = $this->hash->decrypt($user['password']);
            return $password === $decryptedPassword;
        } 
    }
}
