<?php

declare(strict_types=1);

namespace Core\Models;

class User extends Model
{
    public function getAllUsers() :array
    {
        $query = $this->queryBuilder->table('users')
        ->select()
        ->get();

        return $query;
    }

    public function getUserByLogin(string $login) :?array
    {
        $query = $this->queryBuilder
        ->table('users')
        ->select(['id_user','password', 'login'])
        ->where('login', '=', $login)
        ->first();

        return $query;
    }

    public function create(array $data) :int
    {
        return $this->queryBuilder
        ->table('users')
        ->insert([
            'password' => $data['password'],
            'login' => $data['login'],
            'user_name' => $data['username'],
            'middle_name' => $data['middlename'],
            'last_name' => $data['lastname'],
            'type' => $data['type'],
            'region' => $data['region'],
            'city' => $data['city'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'creation_data' => '22.03.22',
            'image' => 'default.jpg',
            'premium_status' => 'standart'
        ]);
    }

    public function addImage(int $userId, string $imageName) :void 
    {
        $this->queryBuilder->table('users')
        ->where('id_user','=', $userId)
        ->update(['image' => $imageName]);
    }

    public function getById(int $id) :array
    {
        $query = $this->queryBuilder
        ->table('users')
        ->select()
        ->where('id_user','=', $id)
        ->first();

        return $query;
    }

    public function setCookie(string $key, string $login) :void
    {
        $this->queryBuilder
        ->table('users')
        ->where('login', '=', $login)
        ->update(['cookie' => $key]);
    }
}