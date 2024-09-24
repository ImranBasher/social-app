<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'picture_id',

        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function givenRequest(){
        return $this->hasMany(Friend::class, 'from_user');
    }

    public function comeRequest(){
        return $this->hasMany(Friend::class, 'to_user');
    }

    public function likedPosts(){
        return $this->hasMany(PostLike::class, 'user_id');
    }

// 'givenRequest','comeRequest'

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function unreadNotifications()
    {
        return $this->notifications()->unread();
    }

    public function unreadNotificationsCount()
    {
        return $this->unreadNotifications()->count();
    }


//    public function unreadNotificationsCount()
//    {
//        return $this->unreadNotifications->count();
//    }




    public function network(){
        return $this->hasMany(UserNetworkk::class);
    }
    public function sendNetwork(){
        return $this->hasMany(UserNetworkk::class, 'user_id');
    }
    public function receiveNetwork(){
        return $this->hasMany(UserNetworkk::class, 'network_user_id');
    }
    public function send(){
        return $this->hasMany(Message::class, 'sender_id');
    }
    public function receive(){
        return $this->hasMany(Message::class, 'receiver_id');
    }























    // The incomingRequests function in the User model defines a one-to-one relationship between the User model and the Friend model.
        # hasOne(Friend::class, 'from_user'): This indicates that each user can have one incoming friend request.
        # Friend::class: This specifies that the related model is the Friend model.
        # 'from_user': This is the foreign key in the Friend model that references the User model. It means that the from_user column in the Friend table holds the ID of the user who sent the friend request.
    // In summary, this function allows you to access the incoming friend request for a user.
    public function incomingRequest()
    {
        return $this->hasOne(Friend::class, 'from_user');
    }

// The incomingRequests function you created in the User model defines a one-to-many relationship between the User model and the Friend model.

    # hasMany(Friend::class, 'from_user'): This indicates that each user can have multiple incoming friend requests.

    # Friend::class: This specifies that the related model is the Friend model.

    #'from_user': This is the foreign key in the Friend model that references the User model. It means that the from_user column in the Friend table holds the ID of the user who sent the friend request.

// In summary, this function allows you to access all incoming friend requests for a user.

    public function incomingRequests()
    {
        return $this->hasMany(Friend::class, 'from_user');
    }

// The outgoingRequest function you created in the User model defines a one-to-one relationship between the User model and the Friend model.

# hasOne(Friend::class, 'to_user'): This indicates that each user can have one outgoing friend request.

# Friend::class: This specifies that the related model is the Friend model

# 'to_user': This is the foreign key in the Friend model that references the User model. It means that the to_user column in the Friend table holds the ID of the user who is the recipient of the friend request.

//In summary, this function allows you to access the outgoing friend request for a user.

    // request came for a specific users id, which located in which column of friends table.

    public function outgoingRequest()
    {
        return $this->hasOne(Friend::class, 'to_user');
    }

    // The outgoingRequests function you created in the User model defines a one-to-many relationship between the User model and the Friend model.

    # hasMany(Friend::class, 'to_user'): This indicates that each user can have multiple outgoing friend requests.

    # Friend::class: This specifies that the related model is the Friend model.

    # 'to_user': This is the foreign key in the Friend model that references the User model. It means that the to_user column in the Friend table holds the ID of the user who is the recipient of the friend request.

    // In summary, this function allows you to access all outgoing friend requests for a user.
    public function outgoingRequests()
    {
        return $this->hasMany(Friend::class, 'to_user')
        ;
    }



    // public function friends()
    // {
    //     return $this->hasMany('User', 'friends', 'to_user', 'from_user');
    // }


    // public function friends()
    // {
    //     return $this->belongsToMany('User', 'friends', 'to_user', 'from_user')
    //     ->orWhere('status', '=', 1);
    //     //return $this->belongsToMany('User');
    // }


    public function scopeAllUser($query, $id){
      return $query->whereDoesntHave('incomingRequests', function($query) use($id){
          $query->where('to_user', $id);
      })->whereDoesntHave('outgoingRequest', function($query) use ($id){
          $query->where('from_user', $id);
      });

      //  dd($query->get()); // This will dump the query result
//      });
    }





}
