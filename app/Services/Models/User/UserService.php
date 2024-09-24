<?php
namespace App\Services\Models\User;
use App\Models\User;
use App\Models\Friend;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function getAll(
        $paginatePluckOrGet = null,
        array $relationships = [],
        $userId = 2
    )
    {
//        return

//        dd( DB::table('users')
//            ->whereNotIn('id', function ($subquery) {
//                $subquery->select('to_user')
//                    ->from('friends')
//                    ->where('from_user', 2)
//                    ->orWhere('to_user', 2);
//            })
//            ->whereNotIn('id', function ($subquery) {
//                $subquery->select('from_user')
//                    ->from('friends')
//                    ->where('from_user', 2)
//                    ->orWhere('to_user', 2);
//            })
//            ->where('user_type', 2)
//            ->get());

// dd(User::allUser($userId)->distinct()->get());




// This is final
return User::whereDoesntHave('incomingRequests', function ($query) use ($userId) {
    $query->where('to_user', $userId);
})->whereDoesntHave('outgoingRequest', function($query) use ($userId){
    $query->where('from_user', $userId);
})->where('user_type', 2)->distinct()->get();












    // return ['users'=>$query];


        // $query2 =   User::distinct()->JOIN('friends', function($join){
        //     $join->on('users.id','=','friends.to_user')->orOn('users.id', '=', 'friends.from_user');
        //  })
        //  ->where(function($query){
        //      $query->where('friends.to_user','=', userId())->orWhere('friends.from_user','=', userId());
        //  })->get(['users.*']);

//          $query3 =  "SELECT * FROM users WHERE id NOT IN
// 	(SELECT to_user FROM friends WHERE from_user = 2 OR to_user = 2)
// AND id NOT IN
// 	(SELECT from_user FROM friends WHERE from_user = 2 OR to_user = 2)
// AND user_type = 2";







        // $query = User::query()->get();

        // $total_row  = $query->count();

        // if($total_row > 0){
        //     !empty($relationships) ? $query->load($relationships) : false;
        // }


        // $users['users'] =  User::query()->whereHas('friends', function($join){
        //                 $join
        //                 ->where('friends.to_user', \userId())
        //                 ->orWhere('friends.from_user', \userId());
        //                 })
        //                 ->get();

        // dd($users['users']);

        // if (is_null($paginatePluckOrGet)) {
        //     return $query->pluck("id", "name");
        // }


}


}
