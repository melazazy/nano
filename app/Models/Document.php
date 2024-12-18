<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'request_id',
        'file_url',
        'original_name',
        'mime_type',
        'size'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function request(): BelongsTo
    {
        return $this->belongsTo(ServiceRequest::class, 'request_id');
    }

    // Helper methods
    public function uploadDocument($file)
    {
        $path = $this->uploadFile($file, 'documents');
        $this->update([
            'file_url' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize()
        ]);
    }

    public function deleteDocument()
    {
        if ($this->deleteFile($this->file_url)) {
            $this->delete();
            return true;
        }
        return false;
    }
}