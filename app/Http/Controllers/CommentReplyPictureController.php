<?php

namespace App\Http\Controllers;

use App\Models\PostCommentReplyPicture;
use Illuminate\Http\Request;

use App\Services\CommentReplyPictureFetcher;
class CommentReplyPictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comment_reply_pictures['comment_reply_pictures'] = (new CommentReplyPictureFetcher())->getAll_(true);

        return view('admin.posts.post_comments.comment_reply.comment_reply_pictures.index')->with($comment_reply_pictures);
    }

}   