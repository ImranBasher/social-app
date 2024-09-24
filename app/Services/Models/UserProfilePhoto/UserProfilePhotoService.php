<?php

namespace App\Services\Models\UserProfilePhoto;

use App\Models\UserProfilePhoto;

class UserProfilePhotoService
{
    public function  storeUserProfilePhoto($photo)
    {
        $destination = "public/profile_photos/";

        $picture = $this->createPicture($photo, $destination, 1);

        $userProfilePhoto['picture_id'] = $picture->id;
        $userProfilePhoto['user_id'] = userId();
        $userProfilePhoto['is_active'] = 1;
        $userProfilePhoto['created_by_id'] = userId();

        UserProfilePhoto::query()->create($userProfilePhoto);
    }
}
