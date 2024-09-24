<?php

namespace App\Services\Models\Friends;
use App\Models\Friend;
class FriendRequestFetcher{
    public function getAll_($paginatePluckOrGet = null, array $relationships = []){
         $id = user()->id;
        $query = Friend::where("to_user",$id)->where("status", 2) ;
        $total_row = $query->count();
        !empty($relationships) ? $query->with($relationships) : $query->with([]);

        if(is_null($paginatePluckOrGet)){
            return [ "data" => $query-> pluck("id", "from_user", "status"), "total"=> $total_row ];
        }
        return [  "data" => $paginatePluckOrGet ? $query->paginate(10) : $query->get(), "total"=> $total_row ];
    }
}
