<?php

namespace App\Models;

class User extends Model
{
    public function getAllUsers()
    {
        $query = $this->db->table('users')
        ->select()
        ->get();

        return $query;
    }

    public function getUserByLogin($login)
    {
        $query = $this->db
        ->table('users')
        ->select(['password', 'login'])
        ->where('login', '=', $login)
        ->first();

        return $query;
    }

    public function create($data)
    {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $query = $this->db
        ->table('users')
        ->insert([
            'password' => $password,
            'login' => $data['login'],
            'user_name' => $data['user_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'type' => 'user',
            'region' => $data['region'],
            'city' => $data['city'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'creation_data' => '22.03.22',
            'image' => 'default.jpg',
            'premium_status' => 'standart'
        ]);

        return $query;
    }

    public function addImage($userId, $imageName)
    {
        $query = $this->db->table('users')
        ->where('id_user', '=', $userId)
        ->update(['image' => $imageName]);
        return $query;
    }
}