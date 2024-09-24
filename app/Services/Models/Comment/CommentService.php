<?php

namespace App\Services\Models\Comment;

use App\Models\CommentReply;
use App\Models\CommentReplyPicture;
use App\Models\PostComment;
use App\Models\PostCommentPicture;
use App\Trait\PictureService;

class CommentService{
    use PictureService;

    const COMMENT_DESTINATION = "public/comment_pictures/";
    public function storeComment(array $comment){
        $comment['user_id']         = userId();
        $comment['created_by_id']   = userId();
        $comment['is_active']       = 1;

        return PostComment::create($comment);
    }

    public function storeCommentPictures( $comment, array $pictures){
        $destination = 'public/comment_pictures';
        foreach($pictures as $pictureFile){

            $picture = $this->createPicture($pictureFile, $destination , 1);

            $commentPictures['post_id']         = $comment->post_id;
            $commentPictures['post_comment_id'] = $comment->id;
            $commentPictures['picture_id']      = $picture->id;
            $commentPictures['user_id']         = userId();
            $commentPictures['is_active']       = 1;
            $commentPictures['created_by_id']   = userId();

            PostCommentPicture::query()->create($commentPictures);
        }

        return $comment;
    }
    protected function commentPicturesFindById( $comment_id):array{
        return PostCommentPicture::query()->where('comment_id', $comment_id)->pluck('picture_id')->toArray();
    }


    public function deletePictures(array $pictures){
        $destination = 'public/comment_pictures';
        $removePictures = $this->removePicture($pictures, $destination);

        if($removePictures){
            $removePictures = $this->commentPicturesFindById($pictures);
            foreach($removePictures as $removePicture){
                $removePicture->delete();
            }
        }
    }



    public function commentFindById($comment_id):array{
        return PostComment::query()
            ->where('comment_id',$comment_id)
            ->pluck('id')
            ->toArray();
    }

    public function updateComment( array $comment, $comment_id ){

        $comment = $this->commentFindById($comment_id);

        if(!empty($comment)){
            $comment['user_id']         = userId();
            $comment['updated_by_id']   = userId();
            $comment['is_active']       = 1;
            return PostComment::query()->update($comment);
        }
        return false;
    }

    protected function commentPicturesFindById( $comment_id):array{
        return PostCommentPicture::query()->whereIn('comment_id', $comment_id)->pluck('picture_id')->toArray();
    }

    protected function commentReplyFindById($comment_id){
        return CommentReply::query()->whereIn('post_comment_id', $comment_id)->pluck('id')->toArray();
    }

    protected function commentReplyPictureFindById($commentReply){
    return CommentReplyPicture::query()->whereIn('post_comment_id', $commentReply)->pluck('picture_id')->toArray();
    }

    protected  function deleteCommentReply(array $commentReply){

        $commentReplyPicture = $this->commentReplyPictureFindById($commentReply);

        if(!empty($commentReplyPicture)){
           //$this->deletePi
        }
    }

    public function deleteComment( $comment_id ){
        $commentPictureId = $this->commentPicturesFindById($comment_id);

        if(!empty($commentPictureId)){
            $this->deleteCommentPictures($commentPictureId, self::COMMENT_DESTINATION);
        }
        $commentReply = $this->commentReplyFindById($comment_id);

        if(!empty($commentReply)){
            $this->deleteCommentReply($commentReply);
        }
    }
}

