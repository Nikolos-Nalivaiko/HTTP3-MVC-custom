<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;

class ImagesService
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function uploadUserImage(array $images, int $userId) :bool
    {
        foreach($images as $image)
        {
            $photoPath = 'usersImages/' . $image['name'];
            if(move_uploaded_file($image['tmp_name'], $photoPath))
            {
                $this->userModel->addImage($userId, $image['name']);
                return true;
            } 
        }
    }
}