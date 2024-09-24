<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;

class PostDataFetcher {

    public function getAll_( $paginatePluckOrGet = null, $onlyParents = null, $onlyActive = null, array $relationships = [ ], $userId = null ) {

        $query =  Post::query();

        if (!is_null($userId)) {
            $query->userId($userId);
        }

         !empty($relationships) ? $query->with($relationships) : $query->with([]);
        userId();

        // $status = (new StatusReposity())->activeUser();

         $user_id = User::query()->find(userId());

        $query->latest();

        if (is_null($paginatePluckOrGet)) {
            return $query->pluck("id", "name");
        }

        return $paginatePluckOrGet ? $query->paginate(5) : $query->get();
    }


    public function singlePost(array $relationships = [], $post_id, $userId = null ) {

        $query = Post::query();

        if($post_id){
            $query->postId($post_id)
                //   ->userId($userId)
                  ;
        }

        if($user_id){
            $query->userId($userId);
        }

        !empty($relationships) ? $query->with($relationships) : false;
        return $query->get();
    }


}
