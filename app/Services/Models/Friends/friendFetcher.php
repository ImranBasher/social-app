<?php
    namespace App\Services\Models\Friends;
    use App\Models\Friend;
    class FriendFetcher
    {
        public function getAll_($paginatePluckOrGet = null, array $relationships = []){
         // dd($relationships);

         $userId = userId();
         $userId2 = userId();

            $query = Friend::query()
                            ->where(function($query2) use($userId, $userId2){
                                $query2->where("to_user", $userId)
                                       ->orWhere("from_user", $userId2);
                            })
                            ->where("status", 1);
            $duplicateQuery = $query;

            $total_row = $duplicateQuery->count();

            if($total_row > 0){
                !empty($relationships) ? $query->with($relationships) : false;
                if(is_null($paginatePluckOrGet  )){
                    return [ "friendData" => $query-> pluck("id", "to_user"," from_user","status"), "total"=> $total_row ];
                   }

                  return [ "friendData" => $paginatePluckOrGet ? $query->paginate(10) : $query->get(), "total"=> $total_row ];
            }else{
                return ["data"=> "No data found."];
            }

            // $query2 = Friend::query()
            //                 ->where("to_user", $userId)
            //                 ->orWhere("from_user", $userId2)
            //                 ->orWhere("status", 0);

            // info("Query is : ".$query->toRawSql());
            // info("Query 2 is : ".$query2->toRawSql());

         //   dd($query->get());

    // select * from friends where ( to_user= 2 OR from_user = 2) OR status = 1 AND status = 2


// dd($relationships);
          //  $total_row = $query->count();
          //  dd(  $paginatePluckOrGet,$relationships, $query, $total_row);





        }
    }
?>
