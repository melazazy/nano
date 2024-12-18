<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'user_id',
        'service_id',
        'status',
        'notes',
        'documents',
        'price',
        'expiry_date'
    ];

    protected $casts = [
        'documents' => 'json',
        'price' => 'decimal:2',
        'expiry_date' => 'date',
        'status' => 'string'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'request_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'request_id');
    }
}