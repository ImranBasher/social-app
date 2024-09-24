<?php

namespace App\Services\Models\CommentReply;

use App\Models\CommentReply;
use App\Models\CommentReplyPicture;
use App\Trait\PictureService;

class CommentReplyService{
    use PictureService;
    public function createCommentReply(array $commentReply):object{

        $commentReply['user_id'] = userId();
        $commentReply['created_by_id'] = userId();
        $commentReply['is_active'] = 1;

        return CommentReply::query()->create($commentReply);
    }

    public function storeCommentReplyPictures( object $comment, array $pictures):void{
        $destination = 'public/comment_reply_pictures/';

        foreach($pictures as $pictureFile){

            $picture = $this->createPicture('$pictureFile', $destination, 1);

            $commentReplyPicture['post_id'] = $comment->post_id;
            $commentReplyPicture['post_comment_id'] = $comment->id;
            $commentReplyPicture['picture_id'] =$picture->id;
            $commentReplyPicture['user_id'] = userId();
            $commentReplyPicture['created_by_id'] = userId();
            $commentReplyPicture['is_active'] = 1;
            CommentReplyPicture::query()->create($commentReplyPicture);
        }
    }
}
