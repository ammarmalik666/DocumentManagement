<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessClient extends Model
{
    use HasFactory;
    protected $table = "business_clients";
    protected $fillable = [
        'business_name',
        'business_email',
        'business_phone',
        'business_mobile',
        'business_physical_address',
        'business_postal_address',
        'contact_name',
        'contact_email',
        'contact_phone',
        'contact_mobile',
        'status'
    ];
}
