<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFriendRequest;
use App\Services\Models\Friends\FriendService;
use App\Http\Requests\StoreAcceptFriendRequest;

class FriendController extends Controller
{


    public function store(StoreFriendRequest $request, FriendService $friendService)
    {
        try{

            $friendService->storeFriend($request->validated());
        }
        catch(\Throwable $e){
            throw $e;
        }
 
        session()->flash('success', 'Send friend Request');
        return redirect()->route('website.users.index');
    }





    public function update($id,FriendService $friendService){
        try
        {
            $friendService->acceptFriend($id);
        }catch(\Throwable $e){
            throw $e;
        }
        session()->flash('success', 'Accept friend Request.');
        return redirect()->route('website.users.index');
    }



    
    public function cancel(StoreFriendRequest $request, FriendService $friendService)
    {
        try{
            $friendService->cancelFriend($request->validated());
        }catch(\Throwable $e){
            throw $e; 
        }

        session()->flash('success', 'friend Request canceled');
        return redirect()->route('website.users.index');
    }
}
