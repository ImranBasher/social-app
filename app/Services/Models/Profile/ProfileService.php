<?php
namespace App\Services\Models\Profile;

use App\Models\Friend;
use App\Models\Post;
use App\Models\PostPicture;
use App\Models\User;
class ProfileService
{
    public function getPosts(
        $paginatePluckOrGet = null,
        $onlyParents = null,
        $onlyActive = null,
        array $relationships = [ ],
        $userId = null )
    {
        $query =  Post::query();
        if (!is_null($userId)) {
            $query->userId($userId);
        }
        !empty($relationships) ? $query->with($relationships) : $query->with([]);
       // $user_id = User::query()->find(userId());
        $query->latest();

        if (is_null($paginatePluckOrGet)) {
            return $query->pluck("id", "name");
        }
        return $paginatePluckOrGet ? $query->paginate(5) : $query->get();
    }
    public function getPhotos(
        $paginatePluckOrGet = null,
        $onlyParents = null,
        $onlyActive = null,
        array $relationships = [ ],
        $userId = null ){

        $query =  PostPicture::query();

        if (!is_null($userId)) {
            $query->where('user_id',$userId);
        }
        !empty($relationships) ? $query->with($relationships) : $query->with([]);
        $query->latest();

        return $paginatePluckOrGet ? $query->paginate(5) : $query->get();
    }

    public function getFriends(
        $paginatePluckOrGet = null,
        $onlyParents = null,
        $onlyActive = null,
        array $relationships = [],
        $userId = null,
        $status = null // Add status as a parameter
    ) {
        $query = Friend::query();

        if (!is_null($userId)) {
            // Fetch friends where the user is either the sender or receiver
            $query->where(function($q) use ($userId) {
                $q->where('from_user', $userId)
                    ->orWhere('to_user', $userId);
            });
        }

        if (!is_null($status)) {
            // Apply the status condition
            $query->where('status', $status);
        }

        // Eager load the relationships
        !empty($relationships) ? $query->with($relationships) : $query->with([]);

        $query->latest();

        if (is_null($paginatePluckOrGet)) {
            return $query;
        }

        return $paginatePluckOrGet ? $query->paginate(5) : $query->get();
    }





}
