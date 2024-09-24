<?php

namespace App\Services\Models\UserCoverPhotoService;

use App\Trait\PictureService as TraitPictureService;
use App\Models\UserCoverPhoto;

class UserCoverPhotoService
{
    use TraitPictureService;

    public function storeUserCoverPhoto($photo)
    {
        $destination = "public/cover_photos";

        $picture = $this->createPicture($photo, $destination, 1);

        $userCoverPhoto['picture_id'] = $picture->id;
        $userCoverPhoto['user_id'] = userId();
        $userCoverPhoto['is_active'] = 1;
        $userCoverPhoto['created_by_id'] = userId();

        UserCoverPhoto::query()->create($userCoverPhoto);

    }
}
