<?php

namespace App\Services\Models\Friends;

use App\Models\Friend;

class FriendService
{

    public function storeFriend(array $payloads)
    {

        $payloads['from_user'] = userId();
        $payloads['created_by_id'] = userId();

        $payloads['status'] = 2;
        // $payloads['status']     = setIsActive();
        // dd($payloads);
        return Friend::create($payloads);
    }

    public function acceptFriend($id){
        $acceptRequest = Friend::where('id', $id);

                                // ->where('to_user', userId())->first();
        if($acceptRequest){
            $acceptRequest->update([
                'status' => 1,
                'updated_by_id' =>userId()
            ]);
        }
    }

    public function cancelFriend($id):void
    {
        $friendRequest = Friend::where('id',$id)
            ->first();

            if($friendRequest){
                $friendRequest->delete();
            }
    }

    public function deleteFromFriend($id){
        $friend = Friend::where('id', $id);
        if($friend){
            $friend->delete();
        }
    }
}
