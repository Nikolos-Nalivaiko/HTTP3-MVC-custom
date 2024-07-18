<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Services\Session;
use App\Services\Cookie;
use App\Services\SecurityService;

class Authenticator
{
    protected User $userModel;
    protected Session $session;
    protected Cookie $cookie;
    protected SecurityService $security;

    public function __construct()
    {
        $this->userModel = new User();
        $this->session = new Session();
        $this->cookie = new Cookie();
        $this->security = new SecurityService();
    }

    public function check() :bool
    {

        $login = $this->cookie->get('login');
        $key = $this->cookie->get('key');

        if($this->session->has('user_id'))
        {
            return true;
        }

        if(empty($login || $key))
        {
            return false;
        }

        $user = $this->userModel->getByCookie($key, $login);

        if(!empty($user))
        {
            $this->session->set('user_id', $user['id_user']);
            return true;
        }

        return false;

    }

    public function logout() :void
    {
        $this->session->destroy();
    }

    public function login($login, $password) :bool
    {
        $user = $this->userModel->getUserByLogin($login);
        
        if($user && password_verify($password, $user['password']))
        {
            $this->session->set('user_id', $user['id_user']);
            return true;
        }

        return false;
    }

    public function remember($login) :void
    {
        
        $key = $this->security->generateSalt();

        $this->userModel->setCookie($key, $login);
        $this->cookie->set('login', $login);
        $this->cookie->set('key', $key);
    }

    public function user() :array
    {
        $user = $this->userModel->getById($this->id());
        return $user;
    }

    public function id() :int
    {
        return $this->session->get('user_id');
    }
}