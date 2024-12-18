<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyData extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'address_en',
        'address_ar',
        'phone',
        'email',
        'website',
    ];
}