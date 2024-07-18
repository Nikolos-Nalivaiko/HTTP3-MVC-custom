<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Services\Session;
use App\Services\HasherService;

class RegistrationService
{
    public User $userModel;
    public Session $session;
    private HasherService $hasher;

    public function __construct()
    {
        $this->userModel = new User();
        $this->session = new Session();
        $this->hasher = new HasherService();
    }

    public function register(array $data) :int 
    {
        $data['password'] = $this->hasher->hash($data['password']);
        $userId = $this->userModel->create($data);
        $this->session->set('user_id', $userId);
        return $userId;
    }
}