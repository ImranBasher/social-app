<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPicture extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'picture_id',
        'user_id',

        'is_active',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
    ];



    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function picture(){
        return $this->belongsTo(Picture::class);
    }



    // use scope for retrieve photos according to user id
    public function scopePicturesByUser($query, $userId){  // $query = it is come from controller
        return $query->where('user_id', $userId)
                     ->with('picture');   // picture = it is model function
    }

}

