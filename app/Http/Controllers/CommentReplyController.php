<?php

namespace App\Http\Controllers;
use App\Models\Picture;
use App\Services\IsActive;
use App\Models\CmmentReply;
use App\Models\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CommentReplyPicture;
use Illuminate\Support\Facades\Auth;
use App\Services\CommentReplyDataFetcher;
use App\Http\Requests\StoreCommentReplyRequest;

class CommentReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comment_replies['comment_replies'] = (new CommentReplyDataFetcher())->getAll_(true);
        return view('admin.posts.post_comments.comment_reply.index')->with($comment_replies);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.posts.post_comments.comment_reply.add_comment_reply');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentReplyRequest $request)
    {
         DB::beginTransaction();

         try{
            $comment_reply = $request->validated();

            $comment_reply['created_by_id'] = Auth::id();
            $comment_reply['is_active'] = (new IsActive())->is_active($request->is_active);

            $comment_reply_id = CommentReply::create($comment_reply);

            if($request->hasFile('images')){
                $path = $this->fileUploder($request->file('images'));
                $picture['pic_name'] = $path;
                $picture['is_active'] = (new IsActive())->is_active($comment_reply['is_active']);
                $picture['created_by_id'] =auth()->user()->id;

                $newImage = Picture::create($picture);


                $commentReplyPicture['post_id'] = //it will come by url
                $commentReplyPicture['post_comment_id'] =$comment_reply_id->id;
                $commentReplyPicture['picture_id'] =$newImage->id ;
                $commentReplyPicture['user_id'] =  Auth::id();

                $commentReplyPicture['is_active'] = $picture['is_active'] ;

                $commentReplyPicture['created_by_id'] =  Auth::id();

                CommentReplyPicture::create($commentReplyPicture);
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return back()->withErrors(['msg', 'Error : ', $e->getMessage()]);
        }

       session()->flash('success', 'a Comment reply add success fully');
        return redirect()->route('comment_replies.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(CommentReply $cmmentReply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comment_reply[ 'comment_reply'] = CommentReply::findOrFail($id) ;
        return view('admin.posts.post_comments.edit_post_comment')->with($comment_reply);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCommentReplyRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $find_id = CommentReply::findOrFail($id);


            $commentReply = $request->validated();
            $commentReply['updated_by_id'] = auth()->user()->id;
            $commentReply['is_active'] = (new IsActive())->is_active($request->is_active);
            $find_id->update($commentReply);

            if($request->hasFile('image')){
                $path = $this->fileUploder($request->file('image'));

                $picture['pic_name'] = $path;
                $picture['is_active'] = (new IsActive())->is_active([$commentReply['is_active']]);
                $picture['updated_by_id'] =  auth()->user()->id;

                $newImage = Picture::create($picture);


                $commentReplyPicture['post_id'] = //it will come by url
                $commentReplyPicture['post_comment_id'] =$find_id->id;
                $commentReplyPicture['picture_id'] =$newImage->id ;
                $commentReplyPicture['user_id'] =  Auth::id();

                $commentReplyPicture['is_active'] = $picture['is_active'] ;

                $commentReplyPicture['updated_by_id'] =  Auth::id();

                CommentReplyPicture::create($commentReplyPicture);
            }

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return back()->withErrors(['msg', 'Error : ', $e->getMessage()]);
        }

       session()->flash('success', 'a Comment reply updated successfully');
        return redirect()->route('comment_replies.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommentReply $cmmentReply)
    {
        $cmmentReply_id = $cmmentReply->get();


        DB::beginTransaction();
        try{

            if (CommentReplyPicture::where('post_commment_id', $cmmentReply_id->id)->exists()){

                $commentReplyPictures = CommentReplyPicture::where('post_commment_id', $cmmentReply_id->id)->get();

                foreach($commentReplyPictures as $commentReplyPicture){
                    $picture = Picture::where('id', $commentReplyPicture->picture_id)->first();
                    $commentReplyPicture->delete();
                    $picture->delete();
                }
            }

            $cmmentReply_id->delete();

            DB::commit();



        }catch(\Throwable $e){
            DB::rollBack();
            return back()->withErrors(['msg'=>'Error : ', $e->getMessage()]);
        }
        session()->flash('success', 'successfully deleted a post');
        return redirect()->route('post_comments.index');
    }
    }

