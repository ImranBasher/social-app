<?php

namespace App\Http\Controllers\Frontend\UserCoverPhoto;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserCoverPhotoRequest;
use App\Services\Models\UserCoverPhoto\UserCoverPhotoService;
use App\Trait\AuthinticatesUsers;
use Illuminate\Http\Request;

class UserCoverPhotoController extends Controller
{
    use AuthinticatesUsers;

    public function __construct(){
        $this->checkAuthintication();
    }
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
    public function store(StoreUserCoverPhotoRequest $request, UserCoverPhotoService $userCoverPhotoService)
    {
        try{
            $userCoverPhotoService->storeUserCoverPhoto($request->validated());
        }catch(\Throwable $exception){
            throw $exception;
        }
        session()->flash("success", "Your cover photo has been uploaded");
        return back();
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
