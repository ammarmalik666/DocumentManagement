<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberUpload extends Model
{
    use HasFactory;
    protected $table = "member_uploads";
    protected $fillable = [
        'client_id',
        'file',
        'filename',
        'status'
    ];
}
