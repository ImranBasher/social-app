<?php

namespace App\Http\Controllers\Frontend\User;

use App\Models\User;
use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Models\User\UserService;
use App\Services\Models\User\UserService1;

class WebUserController extends Controller
{
     public function index1(){

        $users['users'] = (new UserService())->getAll();

        return view('website.users.index1')->with($users);
     }

     public function index()
     {

       $users['users'] =  User::distinct()->JOIN('friends', function($join){
            $join->on('users.id','=','friends.to_user')->orOn('users.id', '=', 'friends.from_user');
         })
         ->where(function($query){
             $query->where('friends.to_user','=', userId())->orWhere('friends.from_user','=', userId());
         })->get(['users.*']);

       // dd($users);


        // working with difficult quries. query problem solving. think query in raw mysql then write it and convert it in eloquent ORM
        // JavaScript
        //Git and Git Hub




        $outGoingRequestUsers = User::query()->whereHas("outgoingRequests",function($query){
            $query->where("from_user", userId());
        })->get();


        $incomingRequestUsers = User::query()->whereHas("incomingRequests",function($query){
            $query->where("to_user", userId());
        })->get();


        $allUsers =  User::query()
            ->doesntHave("incomingRequests")
            ->orDoesntHave("outgoingRequests")
            ->orWhereHas("")
            ->get();

        dd(
            $outGoingRequestUsers,
            $outGoingRequestUsers->count(),
            $incomingRequestUsers,
            $incomingRequestUsers->count(),
            userId(),
            $allUsers

        );

         $userId = userId(); // Ensure this function returns the logged-in user's ID

         $data['users'] = User::whereDoesntHave('outgoingRequests', function ($query) use ($userId) {
             $query->where('to_user', $userId);
         })->whereDoesntHave('incomingRequests', function ($query) use ($userId) {
             $query->where('from_user', $userId);
         })->get();

       //  return view('website.users.index1')->with($data);

// SELECT * FROM users AS u INNER JOIN friends AS f ON u.id = f.to_user  // show all data



// SELECT * FROM users AS u INNER JOIN friends AS f ON u.id = f.to_user WHERE status = 1  // show accepted data


// SELECT * FROM users AS u INNER JOIN friends AS f ON u.id = f.to_user or u.id = f.from_user WHERE f.to_user=2 // show repetative users, from whose friend request coming id and to whose friend request going id


// SELECT DISTINCT u.*  FROM users AS u
// INNER JOIN friends AS f ON (u.id = f.to_user OR u.id = f.from_user)
// WHERE f.to_user = 2 OR f.from_user = 2;                                 // show users, from whose friend request coming id and to whose friend request going id


// SELECT * FROM users AS u WHERE u.id NOT IN
// (SELECT f.to_user FROM friends AS f WHERE f.to_user = 2 OR f.from_user =2)
// AND u.id NOT IN
// ( SELECT f.from_user FROM friends AS f WHERE f.to_user = 2 OR f.from_user =2);   // show users who are not give friend request to user 2 and user 2 also doesnt give friend request of that users





                 //shwo records of  users and show records of friends table  according to "to_user". which indicates how many friends table's ids  are there for users table's  individual id .
        // $data['data'] = User::with('outgoingRequests')->get();

        // only relationships (users and friends) users table data  will show

//          $data['data'] = User::has('incomingRequests')->get();


// dd($data);
       // only relationships (users and friends) users table data which had been changed and became 1  will show
        // $data['data'] = User::whereHas('outgoingRequests',function($q){
        //     $q->where('status', 1);
        // })->get();


        // $data['data'] = User::with('outgoingRequests')->get();
        // // $data['data'] = User::with('outgoingRequests')->whereHas('id',userId())->get();




        // $friends ['friends'] = Friend::where(function ($query){
        //     $query->where('from_user', userId())->orWhere('to_user',userId());
        // })->where('status', 1)->get();




//         // Get incoming friend requests where status is 'accepted'
// $incomingFriends = User::whereHas('incomingRequests', function ($query) {
//     $query->where('status', 1);
// })->where('id', userId())->get();

// // Get outgoing friend requests where status is 'accepted'
// $outgoingFriends = User::whereHas('outgoingRequests', function ($query) {
//     $query->where('status', 1);
// })->where('id', userId())->get();

// // Combine incoming and outgoing friends
// $friends = $incomingFriends->merge($outgoingFriends);


// $friends['friends'] = User::where('id', userId())
//     ->where(function ($query) {
//         $query->whereHas('incomingRequests', function ($query) {
//             $query->where('status', 1);
//         })->orWhereHas('outgoingRequests', function ($query) {
//             $query->where('status', 1);
//         });
//     })->get();

    //    dd($friends);




    // $data['data'] = u

       // return view('website.users.index')->with($data);
    }

    public function friendRequests(){
        $data  = User::with('incomingRequests')->where('id', userId())->get();

        //  dd($data);

         foreach($data  as $d){
            echo $d;
         }


        // foreach ($data['requests'] as $user) {
        //     foreach ($user->incomingRequests as $request) {
        //         echo "Friend request from user ID: " . $request->from_user . " with status: " . $request->status . "\n";
        //     }
        // }

        // $data1['data'] = User::has('incomingRequests')->get();


        // dd($data1);

      //  echo $data;
        //return view('website.users.request')->with($data);





    }


    public function friend(){
        // $usersWithAcceptedRequests = User::whereHas('incomingRequests', function ($query) {
        //     $query->where('status', '1');
        // })->get();

        // foreach( $usersWithAcceptedRequests as $d){
        //     echo $d;
        //  }



        // $user = User::with(['incomingRequests' => function ($query) {
        //     $query->where('status', 'accepted');
        // }, 'outgoingRequests' => function ($query) {
        //     $query->where('status', 'accepted');
        // }])->find(userId());

        // $incomingFriends = $user->incomingRequests->map(function ($friend) {
        //     return $friend->user_incomingRequest;
        // });

        // $outgoingFriends = $user->outgoingRequests->map(function ($friend) {
        //     return $friend->user_outgoingRequest;
        // });

        // // Combine incoming and outgoing friends
        // $allFriends = $incomingFriends->merge($outgoingFriends);

        // // Display friend names
        // foreach ($allFriends as $friend) {
        //     echo "Friend name: " . $friend->name . "\n";
        // }

        $user->friends; // collection of User models, returns the same as:
$user->friends()->get();

dd($user);
    }






}
