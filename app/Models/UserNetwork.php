<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNetwork extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function sender(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'network_user_id');
    }
}
