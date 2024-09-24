<?php

namespace App\Http\Controllers\Frontend\CommentReply;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentReplyRequest;
use App\Models\CommentReply;
use App\Services\Models\CommentReply\CommentReplyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentReplyController extends Controller
{
    public function store(StoreCommentReplyRequest $request, CommentReplyService $commentReplyService  ){

       // dd($request->all());
        try{
            DB::beginTransaction();
           $commentReply = $commentReplyService->createCommentReply($request->validated());

            if($request->hasFile('pic_name')){
                $commentReplyService->storeCommentReplyPictures($commentReply, $request->file( 'pic_name' ));
            }

            DB::commit();
           // return back();
        }catch (\Throwable $exception){
            DB::rollBack();
            throw $exception;
        }
        session()->flash("success", "Success fully add a Comment");
        return redirect()->back();
    }
}
