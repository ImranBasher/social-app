<?php 

namespace App\Services;

use App\Models\PostComment;

class PostCommentDataFetcher
{
    public function getAll($paginatePluckOrGet = null,$relationships = [], $onlyActive = null){

        // make an instance of PostComment model 
        $query = PostComment::query();

        // Bind Relationship
        !empty($relationships) ? $query->with($relationships) : $query->with([ /** give relationship functions */ ]);

        $query->latest(); 

        if(!is_null($onlyActive)){
            $query->where("is_active", $onlyActive);
        }
        if(is_null($paginatePluckOrGet)){
            return $query->pluck("id", "name");
        }
        return $paginatePluckOrGet ? $query->paginate(10) : $query->get();
    }
}