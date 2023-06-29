<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_subscriber');
    }
    protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'user_id'];

}
