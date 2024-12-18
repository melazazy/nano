<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasFileUploads
{
    public function uploadFile(UploadedFile $file, string $path): string
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs($path, $fileName, 'public');
        return $path . '/' . $fileName;
    }

    public function deleteFile(?string $path): bool
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }
}