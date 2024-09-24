<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        'to_user',

        'from_user',

        'status',

        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
     ] ;


     // why this relationships
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function incomingRequest()
    {
        return $this->belongsTo(User::class, 'from_user');
    }

    public function outgoingRequest()
    {
        return $this->belongsTo(User::class, 'to_user');
    }

    public function scopeAUserFriends($query, $userId){
        return $query->where('from_user', $userId)->orWhere('to_user', $userId)->where('status', 1)->with('user');
    }

}
