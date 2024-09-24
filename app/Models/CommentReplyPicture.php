<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReplyPicture extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment_reply_id',
        'post_id',
        'post_comment_id',
        'picture_id',
        'is_active',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
    ];


}

