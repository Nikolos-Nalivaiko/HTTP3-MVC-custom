<?php

declare(strict_types=1);

namespace App\Models;

class User extends Model
{
    public function getAllUsers(): array
    {
        return $this->db->table('users')
            ->select()
            ->get();
    }

    public function getUserByLogin($login): ?array
    {
        return $this->db
            ->table('users')
            ->select(['id_user', 'password', 'login'])
            ->where('login', '=', $login)
            ->first();
    }

    public function getByCookie($cookie, $login): ?array
    {
        return $this->db
            ->table('users')
            ->select()
            ->where('login', '=', $login)
            ->where('cookie', '=', $cookie)
            ->first();
    }

    public function create($data): int
    {
        return $this->db
            ->table('users')
            ->insert([
                'password'       => $data['password'],
                'login'          => $data['login'],
                'user_name'      => $data['user_name'],
                'middle_name'    => $data['middle_name'],
                'last_name'      => $data['last_name'],
                'type'           => 'user',
                'region'         => $data['region'],
                'city'           => $data['city'],
                'phone'          => $data['phone'],
                'email'          => $data['email'],
                'creation_data'  => '22.03.22',
                'image'          => 'default.jpg',
                'premium_status' => 'standart',
            ]);
    }

    public function addImage($userId, $imageName): void
    {
        $this->db->table('users')
            ->where('id_user', '=', $userId)
            ->update(['image' => $imageName]);
    }

    public function getById($id): ?array
    {
        return $this->db
            ->table('users')
            ->select()
            ->where('id_user', '=', $id)
            ->first();
    }

    public function setCookie(string $key, string $login): void
    {
        $this->db
            ->table('users')
            ->where('login', '=', $login)
            ->update(['cookie' => $key]);
    }
}