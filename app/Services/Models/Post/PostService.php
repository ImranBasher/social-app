<?php

namespace   App\Services\Models\Post;

use App\Models\CommentReply;
use App\Models\Post;
use App\Models\Picture;
use App\Models\User;
use App\Models\PostComment;

use App\Models\PostCommentPicture;
use App\Models\PostLike;
use App\Notifications\PostNotification;
use App\Services\IsActive;
use App\Models\PostPicture;
use Illuminate\Notifications\Notifiable;

use App\Services\Models\PostLike\PostLikeService;
//use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Trait\PictureService as TraitPictureService;

class PostService{

    use TraitPictureService;

    const POST_DESTINATION = "public/post_pictures/";
    const COMMENT_DESTINATION = "public/comment_pictures/";
    const COMMENT_REPLY_DESTINATION = "public/comment_reply_pictures/";
    public function postFindById($post_id){
        return Post::query()->findOrFail($post_id);
    }
    public function postPictureIds(array $pictures){   // searh picture_id base on ids those contained by the parameter array
        return PostPicture::query()->whereIn('picture_id', $pictures);
    }
    protected function postPictureMultipleId($post_id):array{ // search picture_id base on a specific post_id.
        return PostPicture::query()->where('post_id', $post_id)->pluck('picture_id')->toArray();
    }
    protected function postCommentFindById($post_id):array{
        return PostComment::query()->where('post_id', $post_id)->pluck('id')->toArray();
    }
    protected function commentPicturesFindById( $comment_id):array{
        return PostCommentPicture::query()->where('comment_id', $comment_id)->pluck('picture_id')->toArray();
    }
    protected function commentReplyFindById($post_id):array{
        return CommentReply::query()->where('post_id', $post_id)->pluck('id')->toArray();
    }
    protected function commentReplyPictureFindById($post_id):array{
        return PostCommentPicture::query()->where('post_id', $post_id)->pluck('picture_id')->toArray();
    }

    
    public function storePost(array $payloads)
    {

        $payloads['title'] = Null;
        $payloads['user_id'] = userId();
        $payloads['created_by_id'] = userId();
        $payloads['is_active']     = setIsActive();


        return Post::query()->create($payloads);
    }

    public function storePostPictures(object $post, $pictures):void{

       // $destination = "public/post_pictures";
        foreach ($pictures as $image) {

            $picture = $this->createPicture($image, self::POST_DESTINATION, 1);

            $postPicture['post_id']  = $post->id;
            $postPicture['picture_id']  =  $picture->id;
            $postPicture['user_id']  = userId();
            $postPicture['is_active']  = 1;
            $postPicture['created_by_id']  = userId();

            PostPicture::create($postPicture);
        }
    }

    public function updatePost(array $payloads , $post_id):void{

        $payloads['title'] = Null;
        $payloads['is_active']     = setIsActive();

        $post = $this->postFindById($post_id);

        $post->title = $payloads['title'];
        $post->post_body = $payloads['post_body'];
        $post->feeling_id = null;
        $post->user_id = userId();
        $post->is_active = $payloads['is_active'];
        $post->updated_by_id = user_id();

        $post->save();
    }

   public function deletePictures(array $pictures, $destination):void{

        $removePictures = $this->removePicture($pictures, $destination);

        if($removePictures){
            $removePostPicture = $this->postPictureIds($pictures);

            foreach($removePostPicture as $removePostPicture){
                $removePostPicture->delete();
            }
        }
    }

    protected function deleteCommentReply($post_id, array $comment_replies):void{
        $commentReplyPicture = $this->commentReplyPictureFindById($post_id);
        if(!empty($commentReplyPicture)){
            $this->deletePictures($commentReplyPicture, self::COMMENT_REPLY_DESTINATION );
        }
        CommentReply::query()->whereIn('comment_reply_id', $comment_replies)->delete();
    }

    protected function deleteComment($post_id, array $comments):void{
        $commentPictureId = $this->commentPicturesFindById($comments);
        if(!empty($commentPictureId)){
            $this->deletePictures($commentPictureId, self::COMMENT_DESTINATION);
        }
        $commentReply = $this->commentReplyFindById($post_id);
        if(!empty($commentReply)){
            $this->deleteCommentReply($post_id, $commentReply);
        }
        PostComment::query()->whereIn('id', $comments)->delete();
    }

    public function deletePost($post_id):void{
        $post = $this->postFindById($post_id);
        if($post){
            $postPictures = $this->postPictureMultipleId($post_id);
            if(!empty($postPictures)){
                $this->deletePictures($postPictures, self::POST_DESTINATION);
            }
            $postComments = $this->postCommentFindById($post_id);
            if(!empty($postComments)){
                $this->deleteComment($post_id, $postComments);
            }
            $post->delete();
        }
    }










}



