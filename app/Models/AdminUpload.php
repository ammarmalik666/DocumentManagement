<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUpload extends Model
{
    use HasFactory;
    protected $table = "admin_uploads";
    protected $fillable = [
        'client_id',
        'file',
        'filename',
        'status'
    ];
}
