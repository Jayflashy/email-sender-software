<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject',
        'domain_id',
        'from_name',
        'email',
        'reply_to', 'code', 'user_id',
    ];

    function template(){
        return $this->belongsTo(Template::class);
    }
    function group(){
        return $this->belongsTo(Group::class);
    }

    function tracker(){
        return $this->hasMany(EmailTracker::class);
    }
}
