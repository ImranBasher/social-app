<?php

namespace   App\Services\Models\Comment;

class CommentService{

    public function deleteComment($comment, PictureService $pictureService, CommentReplyService $commentReplyService){

        $destination = "public/comment_pictures/";

        $pictureService->deletePictures($comment->post_comment_pictures, $destination);

        foreach($comment->comment_replies as $commentReply){
            $commentReplyService->deleteCommentReply($commentReply);
        }

        $comment->post_comment_pictures->delete();

        $comment->delete();
    }

}


