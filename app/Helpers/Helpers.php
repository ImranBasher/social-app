<?php

use App\Utils\AppStatic;

if(!function_exists("userId")){
    function userId(){

        return auth()->id();
    }
}

if(!function_exists("setIsActive")){
    function setIsActive(){

        $isActive  = request()->has("is_active") ? request()->is_active : 0;
        $boolValue = [0,1];

        if( !in_array($isActive,$boolValue)){

            throw new Exception("Value not in array");
        }

        return $isActive;
    }
}

if(!function_exists("user")){
    function user(){

        return auth()->user();
    }
}

if(!function_exists("appStatic")){
    function appStatic(){
        return new AppStatic();
    }
}

if(!function_exists("isAdmin")){
    function isAdmin(){
        $user = user();

        return $user->user_type == appStatic()::USER_TYPE_ADMIN;
    }
}

if(!function_exists("isUser")){
    function isUser(){
        $user = user();

        return $user->user_type == appStatic()::USER_TYPE_USER;
    }
}

if(!function_exists("ddError")){
    function ddError($e){

        dd(errorArray($e));
    }
}


if(!function_exists("errorArray")){
    function errorArray($e){

        return [
           $e->getMessage(),
           $e->getFile(),
           $e->getLine(),
        ];
    }
}

if(!function_exists("isLike")){
    function isLike($value){

        return \appStatic()::POST_LIKE == $value;
    }
}

//if(!function_exists("isUserExist")){
//    function isUserExist($userId){
//      return  User::query()->where("id",$userId)->isExist();
//
//    }
//}
