<?php

namespace App\Http\Controllers\Frontend\Friend;

use App\Services\Models\Friends\FriendRequestFetcher;
use App\Services\Models\Friends\FriendFetcher;
use App\Http\Requests\StoreFriendRequest;
use App\Services\Models\Friends\FriendService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function showRequests(){
        $requestUsers = ( new FriendRequestFetcher())->getALL_(true, ['incomingRequest','outgoingRequest' ]);

       // dd($requestUsers);
        return view("website.users.request")->with($requestUsers);
    }

    public function sendRequest(StoreFriendRequest $request, FriendService $friendService ){
        try{
            $friendService->storeFriend($request->validated());
        }catch(\Throwable $e){
            throw $e;
        }
        session()->flash('success', "send friend request");
        return redirect()->route('website.users.index');
    }

    public function acceptRequest($id, FriendService $friendService){
        try{
            $friendService->acceptFriend($id);
        }catch(\Throwable $e){
            throw $e;
        }

        session()->flash('success',"accepted friend request");
        return redirect()->route('website.friend.requests');
    }

    public function deleteRequest($id, FriendService $friendService){
        try{
            $friendService->cancelFriend($id);
        }catch(\Throwable $e){
            throw $e;
        }
        session()->flash('success',"delete friend request");
        return redirect()->route('website.friend.requests');
    }


    // show friends

    public function showFriends(){
        $friends = ( new FriendFetcher())->getAll_(true, ['incomingRequest','outgoingRequest']);

        return view('website.users.friend')->with($friends);
    }

    public function unfriend($id, FriendService $friendService){
        try{
            $friendService->deleteFromFriend($id);
        }catch(\Throwable $e){
            throw $e;
        }

        session()->flash('success', "Delete friend");
        return redirect()->route('website.friend.showFriends');
    }
}

?>
