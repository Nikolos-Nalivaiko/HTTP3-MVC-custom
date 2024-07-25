<?php

declare(strict_types=1);

namespace App\Services;

class HasherService
{
    private string $cipher = 'aes-256-cbc';
    
    private string $key;
    
    private string $iv;

    public function __construct()
    {
        $this->key = hash('sha256', '2f0e582d11b50a94efc16d1b17e1f7b8eaf9e6d2bc7fd4e2dc1e453c4b315a2e', true);
        $this->iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
    }

    public function encrypt(string $data) :string
    {
        $encrypted = openssl_encrypt($data, $this->cipher, $this->key, 0, $this->iv);

        if($encrypted == false) {
            throw new \RuntimeException('Encryption failed: ' . openssl_error_string());
        }

        return base64_encode($encrypted . '::' . $this->iv);
    }

    public function decrypt(string $data) :string
    {
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
        $decrypted = openssl_decrypt($encrypted_data, $this->cipher, $this->key, 0, $iv);

        if($decrypted == false) {
            throw new \RuntimeException('Decryption failed: ' . openssl_error_string());
        }

        return $decrypted;
    }

    // public function hash(string $password) :string
    // {
    //     return password_hash($password, PASSWORD_BCRYPT);
    // }

}
