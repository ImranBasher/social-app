<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoverPhoto extends Model
{
    use HasFactory;
    protected $fillable = [
        'picture_id',
        'user_id',
        'is_active',

        'created_by_id',
        'updated_by_id',
        'deleted_by_id'
    ];

    public function user_cover_photo(){
        return $this->belongsToMany(Picture::class);
    }
}
