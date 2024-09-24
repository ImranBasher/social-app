<?php

use App\Http\Controllers\Frontend\Message\MessageController;
use App\Models\Picture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\FeelingController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostPictureController;
//use App\Http\Controllers\CommentReplyPictureController;

use App\Http\Controllers\Frontend\User\WebUserController;
use App\Http\Controllers\WebsiteController\WebController;
use App\Http\Controllers\Frontend\Friend\FriendController;
use App\Http\Controllers\Frontend\Comment\CommentController;
use App\Http\Controllers\Frontend\Profile\ProfileController;
use App\Http\Controllers\Frontend\PostController\WebPostController;
use App\Http\Controllers\Frontend\CommentReply\CommentReplyController;

Route::name("website.")->middleware('auth')->group(function(){

   Route::get('platform/login',[WebPostController::class,"websiteLogin"])->name("login");

   // Route::get('//',[WebController::class,"index"]); //TODO::Will add this route into auth protected once login is implemented.

   // Route::get('webindex',[WebPostController::class,"index"]);
   // Route::get('webindex', [WebPostController::class, "index"])->name('post.webindex');
   Route::get('/', [WebPostController::class, "index"])->name('post.index');

   // post
   Route::post('post.store', [WebPostController::class, "store"])->name('post.store');
   Route::get('users.index', [WebUserController::class, 'index1'])->name('users.index');
   Route::delete('delete-post/{postId}', [WebPostController::class, 'destroy'])->name('delete-post');

   // like and dislike
    Route::post('post.like',    [WebPostController::class, 'like'])->name('post.like');
    Route::post('post.dislike', [WebPostController::class, 'disLike'])->name('post.dislike');

   // Comment
    Route::post('comment-store', [CommentController::class,'store'])->name('comment.store');

    // Commment Reply
    Route::post('comment-reply-store', [CommentReplyController::class,'store'])->name('comment.reply.store');


    // profile
    // time-line
   //    Route::get('profile-timeline/{userId}',[ProfileController::class, 'post'])->name('profile.timeline');
   //    Route::get('profile-photo/{userId}',[ProfileController::class, 'photos'])->name('profile.photo');
   //    Route::get('profile-friend/{userId}',[ProfileController::class, 'friends'])->name('profile.friend');

    // helps to go timeline
    Route::get('profile/{userId}/timeline', [ProfileController::class, 'post'])->name('profile.timeline');
    Route::get('profile/{userId}/photos', [ProfileController::class, 'photos'])->name('profile.photos');
    Route::get('profile/{userId}/friends', [ProfileController::class, 'allFriends'])->name('profile.friends');


    //friend
   Route::post('friends.store', [FriendController::class, 'sendRequest'])->name('friends.store');
   Route::delete('friends.deleteRequest/{id}', [FriendController::class, 'deleteRequest'])->name('friends.deleteRequest');
   Route::put('friends.acceptRequest/{id}', [FriendController::class, 'acceptRequest'])->name('friends.acceptRequest');
   Route::get('friend.requests', [FriendController::class, 'showRequests'])->name('friend.requests');
   // helps to go timeline
   Route::get('friend.showFriends', [FriendController::class, 'showFriends'])->name('friend.showFriends');
   Route::delete('friend.unfriend/{id}', [FriendController::class, 'unfriend'])->name('friend.unfriend');

});


// Route::name("website.")->middleware('auth')->group(function(){
//    Route::post('friends.store', [App\Http\Controllers\Frontend\Friend\FriendController::class, 'storeRequest'])->name('friends.store');
//    Route::post('friends.cancel', [App\Http\Controllers\Frontend\Friend\FriendController::class, 'cancel'])->name('friends.cancel');
// });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [AdminController::class, 'index']);

Route::get('/index', [UserController::class, 'index'])->name('user_index');
Route::get('/edit',  [UserController::class, 'index'])->name('edit_user');
Route::get('/delete', [UserController::class, 'destroy'])->name('delete_user');

Route::resource('posts', PostController::class);
Route::resource('feelings', FeelingController::class);
Route::resource('pictures', PictureController::class);
Route::resource('post_pictures', PostPictureController::class);
//Route::resource('post_comments', PostCommentController::class);
//Route::resource('comment_replies', CommentReplyController::class);
//Route::resource('comment_reply_pictures', CommentReplyPictureController::class);

 Route::get('/dashboard', function(){
    return view('admin.layouts.admin');
 });

Route::get('testing/{id}', [ PostController::class, 'destroy'] );


use App\Http\Controllers\NotificationController;

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::get('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::get('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');


Route::get('/index', [MessageController::class, 'index' ])->name('message.index');
Route::get('/message_list', [MessageController::class, 'messageList' ])->name('message.message_list');
//Route::get('/user-network/{id}', [MessageController::class, 'messageList' ])->name('user-network');
Route::get('/message/{id}', [MessageController::class, 'message' ])->name('message');
Route::post('/store', [MessageController::class, 'store' ])->name('message.store');















































































































// //  ->middleware('auth');

// Route::resource('/posts','PostController::class');

// Route::get('/register', [''])















// Route::get('/', [CustomAuthController::class, 'index'])->name('login');
// Route::post('/custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');



// Route::get('/dashboard', 'DashboardController@index')->middleware('auth');
// Route::get('/login', function () {
//     return view('admin.auth.login');
// });

// Route::get('/dashboard', function () {
//     return view('admin.layouts.admin');
// })->middleware('auth');

// Route::view('admin', 'admin.layouts.admin');
