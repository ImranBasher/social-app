<?php

namespace   App\Services\Models\Post;

class PostService_Relationwise
{

    public function deletePost($post_id, PictureService $pictureService, CommentService $commentService ){

        $post = Post::findOrFail($post_id);
        $destination = "public/post_pictures/";
        $pictureService->deletePictures($post->pictures, $destination);

        foreach($post->post_comments as $comment){
            $commentService->deleteComment($comment);
           // $comment->delete();
        }

       $post->post_pictures()->delete();

       $post->delete();
    }
}
