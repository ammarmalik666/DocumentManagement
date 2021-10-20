<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminFolder extends Model
{
    use HasFactory;
    protected $table = "admin_folders";
    protected $fillable = [
        'client_id',
        'folder_name',
        'access_slug',
        'slug',
        'status',
    ];
}
