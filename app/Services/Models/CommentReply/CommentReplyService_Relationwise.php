<?php

namespace App\Services\Models\CommentReply;

class CommentReplyService{

    public function deleteCommentReply($comment_reply,PictureService $pictureService ){

        $destination = "public/comment_reply_pictures";

        $pictureService->deletePictures($comment_reply->comment_reply_picture, $destination);

        $comment_reply->delete();
    }
}
