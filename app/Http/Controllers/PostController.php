<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Feeling;
use App\Models\Picture;
use App\Services\Models\Post\PostService;
use App\Trait\FileUpload;
use App\Services\IsActive;
use App\Models\PostPicture;
use Illuminate\Http\Request;
use App\Services\PostDataFetcher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Services\Models\Picture\PictureService;

class PostController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts['posts'] =( new PostDataFetcher())->getAll_(true,null,null,['feeling']);
        return view("admin.posts.index")->with($posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $feelings['feelings'] = Feeling::get();
        return view('admin.posts.add_post')->with($feelings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, PostService $postService)
    {
        try{
            DB::beginTransaction();

            $post = $postService->storePost($request->validated());

            if($request->hasFile("pic_name")){

                $postService->storePostPictures($post, $request->file('pic_name'));
            }

            DB::commit();
        }
        catch(\Throwable $e){
            DB::rollBack();

            throw $e;
        }






















    //    // dd($request);
    //     DB::beginTransaction();

    //     try{
    //         $post = $request->validated();

    //         $post['created_by_id'] = Auth::id();
    //         $post['is_active'] = (new IsActive())->is_active($request->is_active);

    //         $get_last_post_id = Post::create($post);


    //         if($request->hasFile('pic_name')){

    //           foreach($request->file('pic_name') as $image){

    //                 $path = $this->fileUploder($image);

    //                 $picture['pic_name'] = $path;
    //                 $picture['is_active'] = (new IsActive())->is_active($post['is_active']);

    //                 $picture['created_by_id'] = auth()->user()->id;

    //                 $newImage = Picture::create($picture);

    //                 $postPicture['post_id'] = $get_last_post_id->id;
    //                 $postPicture['picture_id'] =$newImage->id ;
    //                 $postPicture['user_id'] = auth()->user()->id ;

    //                 $postPicture['is_active'] = $picture['is_active'] ;

    //                 $postPicture['created_by_id'] = auth()->user()->id ;

    //                 PostPicture::create($postPicture);
    //            }
    //         }

    //         DB::commit();
    //     }catch(\Exception $e){
    //         DB::rollBack();

    //         throw $e;
    //         // return back()->withErrors(['msg' => 'Error : ', $e->getMessage()]);
    //     }
        session()->flash('success', 'a post add successfully');
        return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = ['post' => Post::findOrFail($id),
                  'feelings' => Feeling::get()];
        return view('admin.posts.edit_post')->with($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, $id)
    {


        try{
            DB::beginTransaction();

            $find_id =Post::findOrFail($id);

            $post = $request->validated();

            $post['updated_by_id'] = auth()->user()->id;

            $post['is_active'] = (new IsActive())->is_active($request->is_active);

            $find_id->update($post);


            if($request->hasFile('pic_name')){

                foreach($request->file('pic_name') as $image){

                    // save picture_path in pictures table
                    $path = $this->fileUploder($request->file('pic_name'));

                    $picture['pic_name'] = $path;
                    $picture['is_active'] = (new IsActive())->is_active($post['is_active']);
                    $picture['updated_by_id'] = auth()->user()->id;

                    $newImage =  Picture::create($picture);


                    // save info of post and picture in post_pic_name table
                    $postPicture['post_id'] = $find_id->id;
                    $postPicture['picture_id'] =$newImage->id ;
                    $postPicture['user_id'] = auth()->user()->id ;

                    $postPicture['is_active'] = $picture['is_active'] ;

                    $postPicture['updated_by_id'] =auth()->user()->id ;

                    PostPicture::create($postPicture);
                }
            }

                // update post table base on id


            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();

            return back()->withErrors(['msg'=>'Error : ', $e->getMessage()]);
        }

        session()->flash('success', 'a post updated successfully');
        return redirect()->route('posts.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $find_id = $post->get();

        DB::beginTransaction();
        try{

            if (PostPicture::where('post_id', $find_id->id)->exists()){

                $postPictures  = PostPicture::where('post_id', $find_id->id)->get();


                foreach($postPictures as $postPicture){
                    $picture = Picture::where('id', $postPicture->picture_id)->first();
                    $postPicture->delete();
                    $picture->delete();
                }
                $find_id->delete();
            }

        //     $find_id->delete();

        //    $this->fileDelete($find_id->pic_name);

        //    PostPicture::where('post_id',$find_id)->delete();

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();

            return back()->withErrors(['msg'=>'Error : ', $e->getMessage()]);
        }
        session()->flash('success', 'a post deleted successfully');
        return redirect()->route('posts.index');

    }
}
