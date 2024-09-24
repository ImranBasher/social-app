<?php

namespace App\Http\Controllers;

use App\Services\PostPictureDataFetcher;

class PostPictureController extends Controller
{
    public function index(){
        $post_pictures['post_pictures'] = (new PostPictureDataFetcher())->getAll_(true);
        return view('admin.posts.post_pictures.index')->with($post_pictures);
    }
}
