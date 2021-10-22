<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = "clients";
    protected $fillable = [
        'client_type',
        'individual_client_id',
        'business_client_id',
        'client_email',
        'password',
        'status'
    ];
}
