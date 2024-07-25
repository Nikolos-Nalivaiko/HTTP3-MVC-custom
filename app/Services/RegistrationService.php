<?php

declare(strict_types=1);

namespace App\Services;

use Core\Models\User;
use App\Services\Session;
use App\Services\HasherService;
use App\Services\SecurityService;

class RegistrationService
{
    public User $userModel;

    public Session $session;

    private HasherService $hasher;

    private SecurityService $security;

    public function __construct()
    {
        $this->userModel = new User();
        $this->session = new Session();
        $this->hasher = new HasherService();
        $this->security = new SecurityService();
    }

    public function register(array $data) :int 
    {
        $data['password'] = $this->hasher->encrypt($data['password']);
        $userId = $this->userModel->create($data);
        $token = $this->security->generateToken($userId, 'off');
        $this->session->set('token', $token);
        $this->session->set('user_id', $userId);
        return $userId;
    }
}