<?php

namespace Helpers;

class ImageHelpers
{
    protected $uploadDir = 'image';

    public function upload(array $image)
    {
        $userId         = SessionHelpers::getUserId();
        $folders        = $this->uploadDir . "/{$userId}/";
        $this->createFolders($folders);
        $relativePath   = $folders . time() . '_' . basename($image['name']);

        if(move_uploaded_file($image['tmp_name'], ASSETS_PATH . $relativePath)){
            return $relativePath;
        }

        return '';
    }

    public function remove(string $path)
    {
        if(file_exists(ASSETS_PATH . $path)){
            unlink(ASSETS_PATH . $path);
        }
    }

    protected function createFolders(string $path)
    {
        if(!file_exists(ASSETS_PATH . $path)){
            mkdir(ASSETS_PATH . $path, 0755, true);
        }
    }
}