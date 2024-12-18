<?php

namespace App\Models;

use App\Traits\HasFileUploads;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, HasFileUploads;

    protected $fillable = [
        'en_name',
        'en_description',
        'ar_name',
        'ar_description',
        'icon',
        'image_url',
        'status',
        'file_count',
        'title_en',
        'title_ar',
    ];

    protected $casts = [
        'status' => 'string',
        'title_en' => 'array', // Cast file_titles to an array
        'title_ar' => 'array', // Cast file_titles to an array
    ];

    // Relationships
    public function requests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    // Helper methods
    public function uploadImage($file)
    {
        if ($this->image_url) {
            $this->deleteFile($this->image_url);
        }

        $path = $this->uploadFile($file, 'services/images');
        $this->update(['image_url' => $path]);
    }

    public function deleteImage()
    {
        if ($this->deleteFile($this->image_url)) {
            $this->update(['image_url' => null]);
            return true;
        }
        return false;
    }
}
