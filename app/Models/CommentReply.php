<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_reply_body',
        'post_id',
        'post_comment_id',
        'user_id',

        'is_active',

        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
];
    public function comment_reply_user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function comment_reply_picture(){
        return $this->hasMany(CommentReplyPicture::class);
    }

    public function pictures(){
        return $this->hasManyThrough(Picture::class, 'comment_reply_id', 'id', 'id', 'picture_id');
    }
}

