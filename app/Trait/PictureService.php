<?php
namespace App\Trait;

use App\Models\Picture;
use App\Trait\FileUpload;
use App\Models\PostPicture;
use Illuminate\Support\Facades\Auth;

trait PictureService
{
    use FileUpload;
// ------------------

public function deletePictures(array $pictures, $destination):void{

    foreach($pictures as $picture){
        $filePath = $destination.$picture->pic_name;
        if(file_exists($filePath)){
            unlink($filePath);
        }
        $picture->delete();
    }
}


// ------------------
    public function createPicture($image,$destination, $is_active){  // $destination contains where (directory) you want to upload or keep your file or picture
        $path = $this->fileUploder($image, $destination); // $fileRename which contains a uniqe name base on user_userId().extention (e.g. user_2.png )

        $picture['pic_name']        = $path;
        $picture['is_active']       = $is_active;
        $picture['created_by_id']   = userId();

        return Picture::create($picture);
    }


    public function pictureIds(array $pictures){
        return Picture::query()->whereIn('id', $pictures)->get(); // SELECT * FROM pictures WHERE id IN ($pictures); suppose $picture contain [3,4,7] . so 3,4,7 is the id's of Picture model table
    }


    public function removePicture(array $pictures, $destination):bool{
         $removePictures = $this->pictureIds($pictures);
         $this->fileDelete($removePictures, $destination);
         return $this->checkIfPicturesRemove($removePictures,$destination );
    }




    public function findSinglePicture($id){
        return Picture::find($id);
    }

    protected function checkIfPicturesRemove($files, $destination):bool{
        foreach($files as $file){
            $picture = $this->findSinglePicture($file);
            if($file && file_exists($destination.$file->pic_name)){
                return false;
            }
        }
        return true;
    }
}



