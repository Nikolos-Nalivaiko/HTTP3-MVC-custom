<?php

namespace App\Services;

use App\Models\User;
use App\Services\Session;
use App\Services\Cookie;

class Authenticator
{
    protected $userModel;
    protected $session;
    protected $cookie;

    public function __construct()
    {
        $this->userModel = new User();
        $this->session = new Session();
        $this->cookie = new Cookie();
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

    // По ідеї регістрація не задача Authenticator сервісу. По ідеї це повинен бути RegistrationService, або щось в такому дусі
    public function register($data)
    {
        // Краще завести окремий сервіс для хешування, щось в дусі HasherService який буде займатись чисто задачами хешування
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $userId = $this->userModel->create($data);
        $this->session->set('user_id', $userId);
        return $userId;
    }

    public function check() // specify return type
    {

        $login = $this->cookie->get('login');
        $key = $this->cookie->get('key');

        if ($this->session->has('user_id')) {
            return true;
        }

        if (empty($login) || empty($key)) {
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

    public function logout()
    {
        $this->session->destroy();
    }

    public function login($login, $password)
    {
        $user = $this->userModel->getUserByLogin($login);

        // верифікацію пароля також можна винести в сервіс, типу CredentialsVerificationService
        if($user && password_verify($password, $user['password']))
        {
            $this->session->set('user_id', $user['id_user']);
            return true;
        }

        return false;
    }

    public function remember($login)
    {
        // І знову ж таки, це також можна винести в якийсь SecurityService, який буде займатись секретами, ключами і т.д.
        $key = $this->generateSalt();

        $this->userModel->setCookie($key, $login);
        $this->cookie->set('login', $login);
        $this->cookie->set('key', $key);
    }

    public function user()
    {
        return $this->userModel->getById($this->id());
    }

    public function id()
    {
        return $this->session->get('user_id');
    }

    private function generateSalt() {
        $salt = '';
        $saltLenght = 10;

        for($i = 0; $i < $saltLenght; $i++) {
            $salt .= chr(mt_rand(33,126));
        }

        return $salt;
    }
}