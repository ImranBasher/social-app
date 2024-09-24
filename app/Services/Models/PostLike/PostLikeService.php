<?php

namespace App\Services\Models\PostLike;

use App\Models\Post;
use App\Models\PostLike;
use App\Models\User;

class PostLikeService
{
    public function getPostLikeByPostIdAndUserId($post_id, $user_id, $isFirst = true)
    {
        $query = PostLike::query()
            ->where('post_id', $post_id)
            ->where('user_id', $user_id);

        return $isFirst ? $query->first() : $query->exists();
    }

    /**
     * Object returning
     * */
    public function postLikeStore($post_id, $user_id, $isLike = true)
    {
        return PostLike::query()->create([
           "post_id" => $post_id,
           "user_id" => $user_id,
           "like" => $isLike ? appStatic()::POST_LIKE : appStatic()::POST_DISLIKE,
        ]);
    }

    /**
     * @incomingParams $postLike contains post_likes object
     * @incomingParams $isLike contains 1 for like, 0 for dislike
     * */
    public function postLikeUpdate(object $postLike, $isLike)
    {
        $postLike->update([
            "like" => $isLike
        ]);

        return $postLike;
    }

    public function likePost($request){

        $postLike = $this->getPostLikeByPostIdAndUserId($request->post_id, userId());

        if(empty($postLike)) {
            $like = $this->postLikeStore($request->post_id, userId(), appStatic()::TRUE);
            $this->sendNotification($request->post_id);
            return $like;
        }
        /**
         * When post already like by login id(me)
         */
        if(!isLike($postLike->like)){
            return $postLike->delete();
        }
       // return $postLike->delete();
        $this->sendNotification($request->post_id);
        return $this->postLikeUpdate($postLike, appStatic()::POST_LIKE);
    }
    public function dislikePost($request, $user_id){
        $dislikePost = $this->getPostLikeByPostIdAndUserId($request->post_id, $user_id);
        /**
         * When post isn't like/dislike by me
         * */
        if(empty($dislikePost)) {
            return $this->postLikeStore($request->post_id, $user_id, appStatic()::FALSE);
        }
        /**
         * When post is already dislike by me, then will delete it, because you click on dislike button 2nd time
         * */
       if(!isLike($dislikePost->like)){  //
           return $dislikePost->delete();
       }
       /**
        * when post is already like by me
        * */

        return $this->postLikeUpdate($dislikePost, appStatic()::POST_DISLIKE);
    }

    private function sendNotification($postId)
    {
        $post = Post::find($postId);
        $postOwner = User::find($post->user_id);

        // Only send the notification if the post owner is different from the liker
        if ($postOwner->id !== userId()) {
            $postOwner->notify(new PostLikedNotification($post));
        }

    }
}
