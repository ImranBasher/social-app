<?php

namespace App\Http\Controllers\Frontend\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostCommentRequest;
use App\Services\Models\Comment\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function store(
        StorePostCommentRequest $request,
        CommentService $commentService
    ){

        try{
            DB::beginTransaction();

            $comment = $commentService->storeComment($request->validated());

            if($request->hasFile('pic_name')){
                $commentService->storeCommentPictures($comment, $request->file('pic_name') );
            }
            DB::commit();

        }catch(\Throwable $exception){
            DB::rollBack();
            throw $exception;
        }
        session()->flash("success", "Success fully add a Comment");
        return redirect()->back();
    }

    public function edit($post_id){

    }

    public function update(
        $comment_id,
        StorePostCommentRequest $request,
        CommentService $commentService)
    {
        try{
            DB::beginTransaction();
            $comment = $commentService->updateComment($request->validated(), $comment_id);

            if($request->hasFile('remove_pictures')){
                $commentService->deletePictures($request->file('remove_pictures'));
            }

            if($request->hasFile('pic_name')){
                $commentService->storeCommentPictures($comment, $request->file('pic_name') );
            }
            DB::commit();
        }catch(\Throwable $exception){
            DB::rollBack();
            throw $exception;
        }
        session()->flash("success", "Success fully update a Comment");
        return redirect()->back();
    }


    public function destroy($comment_id, CommentService  $commentService){
        try{
            DB::beginTransaction();
            $commentService->deleteComment( $comment_id );
            DB::commit();
        }catch (\Throwable $exception){
            DB::rollBack();
            Log::error('Error deleting post: ' . $exception->getMessage());
            throw $exception;
        }
    }





}
