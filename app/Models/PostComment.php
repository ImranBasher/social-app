<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_body',
        'post_id',
        'user_id',

        'is_active',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
    ];

    public function post_comment_user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function post_comment_pictures(){
        return $this->hasMany(PostCommentPicture::class);
    }

    public function pictures(){
        return $this->hasManyThrough(Picture::class, PostCommentPicture::class, 'post_comment_id', 'id', 'id','picture_id');
        // post_comment_id = foreign key post_comment_pictures table
        // id  = local key of post_comment table
        // id  = local key of post_comment_pictures table
        // picture_id = foreign key of post_pictures table for
    }

    public function comment_replies(){
        return $this->hasMany(CommentReply::class, 'post_comment_id', 'id');
    }

}


