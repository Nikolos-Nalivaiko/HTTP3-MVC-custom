<?php

namespace App\Services;

use App\Models\User;
use App\Services\Session;

class Authenticator
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new User();
        $this->session = new Session();
    }

    public function checkCredentials($password, $login)
    {
        $user = $this->userModel->getUserByLogin($login);
        
        if($user && password_verify($password, $user['password']))
        {
            return false;
        }

        return true;
    }

    public function register($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $userId = $this->userModel->create($data);
        $this->session->set('user_id', $userId);
        return $userId;
    }

    public function check()
    {
        return $this->session->has('user_id');
    }

    public function logout()
    {
        $this->session->destroy();
    }

    public function login($login, $password)
    {
        $user = $this->userModel->getUserByLogin($login);
        
        if($user && password_verify($password, $user['password']))
        {
            $this->session->set('user_id', $user['id_user']);
            return true;
        }

        return false;
    }

    public function user()
    {
        $user = $this->userModel->getById($this->id());
        return $user;
    }

    public function id()
    {
        return $this->session->get('user_id');
    }
}