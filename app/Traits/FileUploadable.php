<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUploadable
{
    /**
     * Dosya yükleme işlemi.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @return string
     */
    public function uploadFile($file, $directory)
    {
        $path = $file->store($directory, 'public');
        return $path;
    }

    /**
     * Dosyayı silme işlemi.
     *
     * @param string $filePath
     * @return bool
     */
    public function deleteFile($filePath)
    {
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->delete($filePath);
        }
        return false;
    }
}
