<?php

declare(strict_types=1);

namespace App\Services;

class ImageUploadService
{
    public function uploadImage(array $image, string $directory) :?string
    {
        $photoPath = $directory . '/' . $image['name'];
        if (move_uploaded_file($image['tmp_name'], $photoPath)) {
            return $image['name'];
        }
        return null;
    }
}