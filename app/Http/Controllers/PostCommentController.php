<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Trait\FileUpload;
use App\Services\IsActive;
use App\Models\PostComment;
use Illuminate\Http\Request;
use App\Models\PostCommentPicture;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostCommentRequest;

use App\Services\PostCommentDataFetcher;

class PostCommentController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post_comments['post_comments'] = (new PostCommentDataFetcher())->getAll(true);

        return view('admin.posts.post_comments.index')->with($post_comments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.post_comments.add_post_comment');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostCommentRequest $request)
    {
        DB::beginTransaction();

        try{
            $postComment = $request->validated();

            $postComment['created_by_id'] = auth()->user()->id;
            $postComment['is_active'] = (new IsActive())->is_active($request->is_active);

            $postComment_id = PostComment::create($postComment);

            if($request->hasFile('images')){

                $path = $this->fileUploder($request->file('images'));

                $picture['pic_name'] = $path;

                $picture['is_active'] = (new IsActive())->is_active($postComment['is_active']);
                $picture['created_by_id'] =auth()->user()->id;

                $newImage = Picture::create($picture);

                $postCommentPicture['post_id'] = //it will come by url
                $postCommentPicture['post_comment_id'] =$postComment_id->id;
                $postCommentPicture['picture_id'] =$newImage->id ;
                $postCommentPicture['user_id'] = auth()->user()->id ;

                $postCommentPicture['is_active'] = $picture['is_active'] ;

                $postCommentPicture['created_by_id'] = auth()->user()->id ;
                $postCommentPicture['updated_by_id'] =null ;

                PostCommentPicture::create($postCommentPicture);

            }

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return back()->withErrors(['msg', 'Error : ', $e->getMessage()]);
        }

       session()->flash('success', 'a Comment add success fully');
        return redirect()->route('post_comments.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(PostComment $postComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post_comment[ 'post_comment'] = PostComment::findOrFail($id) ;
        return view('admin.posts.post_comments.edit_post_comment')->with($post_comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostCommentRequest $request, $id)
    {


        DB::beginTransaction();

        try{
            $find_id = PostComment::findOrFail($id);

            $postComment = $request->validated();
            $postComment['updated_by_id'] = auth()->user()->id;
            $postComment['is_active'] = (new IsActive())->is_active($request->is_active);
            $find_id->update($postComment);

            if($request->hasFile('image')){
                $path = $this->fileUploder($request->file('image'));

                $picture['pic_name'] = $path;
                $picture['is_active'] = (new IsActive())->is_active([$postComment['is_active']]);
                $picture['updated_by_id'] =  auth()->user()->id;

                $newImage = Picture::create($picture);

                $postCommentPicture['post_id'] = $find_id->id;
                $postCommentPicture['picture_id'] = $newImage->id;
                $postCommentPicture['user_id'] = auth()->user()->id;

                PostCommentPicture::create($postCommentPicture);
            }

            DB::commit();

        }catch(\Throwable $e){

            DB::rollBack();

            return back()->withErrors(['msg'=> 'Error : ' .$e->getMessage()]);
        }

        session()->flash('success','Post Comment updated successfully');
        return redirect()->route('post_comments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostComment $postComment)
    {
        $postComment_id = $postComment->get();

        DB::beginTransaction();
        try{

            if (PostCommentPicture::where('post_commment_id', $postComment_id->id)->exists()){

                $postCommentPictures = PostCommentPicture::where('post_commment_id', $postComment_id->id)->get();

                foreach($postCommentPictures as $postCommentPicture){
                    $picture = Picture::where('id', $postCommentPicture->picture_id)->first();
                    $postCommentPicture->delete();
                    $picture->delete();
                }
            }

            $postComment_id->delete();

            DB::commit();



        }catch(\Throwable $e){
            DB::rollBack();
            return back()->withErrors(['msg'=>'Error : ', $e->getMessage()]);
        }
        session()->flash('success', 'successfully deleted a post');
        return redirect()->route('post_comments.index');
    }
}
