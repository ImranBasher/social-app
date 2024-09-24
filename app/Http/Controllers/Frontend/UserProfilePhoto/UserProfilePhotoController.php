<?php

namespace App\Http\Controllers\Frontend\UserProfilePhoto;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserProfilePhotoRequest;
use App\Services\Models\UserProfilePhoto\UserProfilePhotoService;

class UserProfilePhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserProfilePhotoRequest $request, UserProfilePhotoService  $userProfilePhotoService)
    {
        try{
            if($request->hasFile('pic_name')){
                $userProfilePhotoService->storeUserProfilePhoto(file($request->hasFile('pic_name')));
            }

        }catch(\Throwable $exception){
            throw $exception;
        }

        session()->flash('success',"your profile photo has been uploaded" );
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
