<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Session;

class SecurityService
{

    private Session $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function generateSalt() :string
    {
        $salt = '';
        $saltLenght = 10;

        for($i = 0; $i < $saltLenght; $i++) {
            $salt .= chr(mt_rand(33,126));
        }

        return $salt;
    }

    public function generateToken(int $userId, string $remember) :string
    {
        $expirationTime = $remember ? (time() + (60 * 60 * 24 * 7)) : (time() + (60 * 60));
        $payload = base64_encode(json_encode([
            'user_id' => $userId,
            'exp' => $expirationTime
        ]));

        $signature = hash_hmac('sha256', $payload, '2f0e582d11b50a94efc16d1b17e1f7b8eaf9e6d2bc7fd4e2dc1e453c4b315a2e');
        return $payload . '.' . $signature;
    }

    public function checkToken(?string $token) :bool
    {
        if(empty($token)) {
            return false;
        }

        list($payload, $signature) = explode('.', $token);
        $expectedSignature = hash_hmac('sha256', $payload, '2f0e582d11b50a94efc16d1b17e1f7b8eaf9e6d2bc7fd4e2dc1e453c4b315a2e');
    
        if (hash_equals($signature, $expectedSignature)) {
            $data = json_decode(base64_decode($payload), true);
            if ($data['exp'] > time()) {
                $this->session->set('user_id', $data['user_id']);
                return true;
            }
        }
    
        return false;
    }
}