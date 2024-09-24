<?php


namespace App\Trait;

use Exception;
use Illuminate\Support\Facades\Storage;

trait FileUpload{


    /**
     *
     * 1. Get the file by argument variable.
     * 2. Get pathname
     * 3. check file exist or not
     * 4. get extention
     */
    public function fileUploder($file, $destination){

//dd($destination);
        try{
            $temp_name = $file->getPathname();
            // dd($filename,$temp_name);
            if(file_exists($temp_name)){
           $extension = $file->getClientOriginalExtension();

                $fileRename = $this->fileRename($extension);
                $before_store = $fileRename;
                //dd($extention,$fileRename);
                // $destination =   "public/imran1";
                $saved = $file->storeAs($destination,$fileRename);
                // dd(
                //     $destination, $saved
                // );
                // dd($before_store,$fileRename, $filename->storeAs( 'public',$fileRename));
                return $fileRename;
            }else{
                 throw  new Exception("File not found");
            }
        }catch(Exception $e){
            //ddError($e);
            return false;
        }

    }

    public function fileRename($extension){
        $randomString = uniqid(rand(), true);
        return 'user_'.userId().'_'.$randomString.'.'.$extension;
    }

    public function fileDelete($files, $destination){

        foreach($files as $file){

            $file_path = storage_path($destination);

            if(file_exists($file_path)){
                Storage::delete($destination.$file->pic_name);
                $file->delete();
            }
        }
    }







}
