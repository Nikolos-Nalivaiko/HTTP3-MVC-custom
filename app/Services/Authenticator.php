<?php

declare(strict_types=1);

namespace App\Services;

use Core\Models\User;
use App\Services\Session;
use App\Services\Cookie;
use App\Services\SecurityService;
use App\Services\CredentialsVerificationService;
use App\Services\HasherService;

class Authenticator
{
    protected User $userModel;
    protected Session $session;
    protected Cookie $cookie;
    protected SecurityService $security;
    protected HasherService $hash;
    protected CredentialsVerificationService $credentials;

    public function __construct()
    {
        $this->userModel = new User();
        $this->session = new Session();
        $this->cookie = new Cookie();
        $this->security = new SecurityService();
        $this->credentials = new CredentialsVerificationService();
        $this->hash = new HasherService();
    }

    public function check() :bool
    {
        $token = $this->session->get('token') ?? $this->cookie->get('token') ?? null;
        return $this->security->checkToken($token);
    }

    public function logout() :void
    {
        $this->session->destroy();
    }

    public function login(string $login, string $password, string $remember) :bool
    {
        $user = $this->credentials->verifyLogin($login);
        
        if($user['status'] == true) {
            $user = $user['user'];
        } else {
            $user = null;
        }
    
        if(!empty($user)) {
            $decryptedPassword = $this->hash->decrypt($user['password']);
            if($password === $decryptedPassword) {
                $token = $this->security->generateToken($user['id_user'], $remember);

                if($remember) {
                    $this->cookie->set('token', $token, time() + (60 * 60 * 24 * 7));
                } else {
                    $this->session->set('token', $token);
                }

                $this->session->set('user_id', $user['id_user']);
                return true;
            }
        }
    
        return false;
    }

    public function user() :array
    {
        if($this->id()) {
            $user = $this->userModel->getById($this->id());
        } else {
            $user = [];
        }

        return $user;
    }

    public function id() :int
    {
        return $this->session->get('user_id');
    }
}