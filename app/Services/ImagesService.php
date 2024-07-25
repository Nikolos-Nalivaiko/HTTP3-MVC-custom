<?php

declare(strict_types=1);

namespace App\Services;

use Core\Models\User;
use App\Services\ImageUploadService;

class ImagesService
{
    private User $userModel;

    private ImageUploadService $imageUpload;

    public function __construct()
    {
        $this->userModel = new User();
        $this->imageUpload = new ImageUploadService();
    }

    public function uploadUserImage(array $images, int $userId) :bool
    {
        foreach($images as $image) {
            $imageName = $this->imageUpload->uploadImage($image, 'usersImages');
            if ($imageName) {
                $this->userModel->addImage($userId, $imageName);
                return true;
            }
        }
        return false;
    }
}