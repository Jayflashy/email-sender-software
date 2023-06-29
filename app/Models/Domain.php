<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'from_name',
        'reply_to',
        'status',
        'user_id'
    ];
}
