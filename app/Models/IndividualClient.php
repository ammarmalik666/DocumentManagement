<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualClient extends Model
{
    use HasFactory;
    protected $table = "individuals_clients";
    protected $fillable = [
        'name',
        'email',
        'phone',
        'mobile',
        'physical_address',
        'postal_address',
        'status'
    ];
}
