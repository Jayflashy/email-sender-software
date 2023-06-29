<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function subscribers()
    {
        return $this->belongsToMany(Subscriber::class, 'group_subscriber');
    }

}
