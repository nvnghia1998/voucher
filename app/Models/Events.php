<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Events extends Model
{
    use HasFactory;
    protected $table = "events";
    public function user()
    {
        return $this->belongsToMany(User::class,'event_user', 'event_id', 'user_id');
    }
}
