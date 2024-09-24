<?php

namespace App\Http\Controllers\Frontend\PostController;

use App\Models\Notification;
use App\Models\User;
use App\Services\Models\PostLike\PostLikeService;
use App\Trait\JsonResponse;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Services\PostDataFetcher;
use App\Trait\AuthinticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreLikeRequest;
use App\Services\Models\Post\PostService;

class WebPostController extends Controller
{
    use AuthinticatesUsers;
    use JsonResponse;

    public function __construct()
    {
        // dd(Auth::user());
        $this->checkAuthintication();
    }

    // public function websiteLogin(){
    //     return view("website.login");
    //   }

    public function index(){


//      $user = User::query()->first();
       // dd($user->notifications);
        $user = Auth::user();

        $data['notifications'] = $user->notifications()->whereNull('read_at')->get();
      //  dd($data['notifications']);
        $data['unreadNotificationsCount'] = $data['notifications']->count();

        //dd( $data['unreadNotificationsCount']);

        $data['posts'] = (new PostDataFetcher())->getAll_(true,null,null,
            [
                'post_user',
                'post_pictures',
                'post_comments.post_comment_user',
                'post_comments.post_comment_pictures',
                'post_comments.comment_replies.comment_reply_user',
                'post_comments.comment_replies.comment_reply_picture'
            ]);

        return view('website.index')->with($data);
    }
    public function store(StorePostRequest $request, PostService $postService){

        //dd($request->all());
        try{
            DB::beginTransaction();
            $users = User::all();
            $post = $postService->storePost($request->validated());

//            $data['id']= $post['id'];
//            $data['post_body'] = $post['body'];
//            Notification::send( $users, new PostNotification($data));
            // foreach($users as $user){
            //     $user->notify(new PostNotification($post));
            // }

            if($request->hasFile("pic_name")){
                $postService->storePostPictures($post, $request->file('pic_name'));
            }

            DB::commit();
        }
        catch(\Throwable $e){
            DB::rollBack();

            ddError($e);

            throw $e;
        }

        session()->flash('success', 'Successfully add a post');
        return redirect()->route('website.post.index');
    }

    public function edit( $post_id){
        $post['post'] = ( new PostDataFetcher())->singlePost([
            'post_user',
            'post_pictures',
            'post_comments.post_comment_user',
            'post_comments.post_comment_pictures',
            'post_comments.comment_replies.comment_reply_user',
            'post_comments.comment_replies.comment_reply_picture'
        ], $post_id);
        view('website.post.edit_post')->with($post);
    }

    public function update(StorePostRequest $request, PostService $postService, $post_id){

        try{
            DB::beginTransaction();
            $postService->updatePost($request->validated(), $post_id);
            $destination = "public/post_pictures/";
            
            if($request->hasFile('remove_pictures')){
                $postService->deletePictures($request->file('remove_pictures'), $destination);
            }
            if($request->hasFile('pic_name')){
                $postService->storePostPictures($post_id, $request->file('pic_name'));
            }
            DB::commit();
        }catch(\throwable $exception){
            DB::rollback();
            throw $exception;
        }

        session()->flash('success', 'Successfully updated post');
        return redirect()->back();

    }

    // public function destroy($post_id, PostService $postService){
    //     // try{
    //     //     DB::beginTransaction();

    //     //     $postService->deletePost($post_id);

    //     //     $postService->deletePostPictures($post_id);

    //     //     DB::commit();
    //     // }catch(\Throwable $exception){
    //     //     DB::rollback();
    //     //     throw $exception;
    //     // }

    // }

        public function destroy($post_id, PostService $postService){
            try{
                DB::beginTransaction();
                $postService->deletePost($post_id);
                DB::commit();
            }catch(\Throwable $exception){
                DB::rollback();
                Log::error('Error deleting post: ' . $exception->getMessage());
                throw $exception;
            }
        }


        public function like(StoreLikeRequest $request, PostLikeService $postLikeService){
            try{
                $data = $postLikeService->likePost($request);
                return  $this->successResponse($data);
            }catch(\Throwable $exception){
                DB::rollback();
                return $this->errorResponse("An error occurred while processing your request.", $exception, false, 500);
            }
        }

        public function dislike(StoreLikeRequest $request, PostLikeService $postLikeService){
            try{
                $data = $postLikeService->dislikePost($request, userId());
                return  $this->successResponse($data);
            }catch(\Throwable $exception){
                DB::rollback();
                return $this->errorResponse("An error occurred while processing your request.", 500);
            }
        }
}
