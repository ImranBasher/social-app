<?php

namespace App\Http\Controllers\Frontend\Profile;

use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\Picture;
use App\Models\Post;
use App\Models\PostPicture;
use App\Services\PostDataFetcher;
use App\Services\Models\Profile\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function post($userId){
        $data['posts'] = (new ProfileService())->getPosts(true, null, null,[
            'post_user',
            'post_pictures',
            'post_comments.post_comment_user',
            'post_comments.post_comment_pictures',
            'post_comments.comment_replies.comment_reply_user',
            'post_comments.comment_replies.comment_reply_picture'
        ], $userId);

//        $user_id['userId'] = $userId;

       // $data['userId'] = $userId;

        return view('website.user_profile.profile.timeline')->with($data);
    }

    public function photos($userId) {

        $data["pictures"] = (new ProfileService())->getPhotos(null, null, null, ['picture'], $userId);

        $data["userId"] = $userId;


        return view('website.user_profile.profile.photos')->with($data);
    }

    public function getPostPhotos_Using_scope_according_To_userId($userId){
        $pictures = PostPicture::picturesByUser($userId)->get();   // Now you have all PostPictures created by the user with their associated Picture models
        return view('website.user_profile.profile.photos')->with($pictures);
    }

//    public function friends($userId){
//        $friends = Friend::aUserFriends($userId)->get();
//        $total = $friends->count();
//
//        return view('website.user_profile.profile.friends')->with([$friends, $total]);
//    }

    public function allFriends($userId)
    {
      //  dd($userId);
        $data['friends'] = (new ProfileService())->getFriends(null, null, null, ['incomingRequest', 'outgoingRequest'], $userId, 1);
        $data['total'] = $data['friends']->count();

        $data['userId'] = $userId;

        return view('website.user_profile.profile.friends')->with($data);
    }

}

