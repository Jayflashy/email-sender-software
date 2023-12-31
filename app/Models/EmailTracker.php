<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTracker extends Model
{
    use HasFactory;

    public function campaign()
    {
        return $this->hasOne(Campaign::class);
    }
    public function subscriber()
    {
        return $this->hasOne(Subscriber::class);
    }
}
