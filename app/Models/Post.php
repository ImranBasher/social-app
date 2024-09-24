<?php

namespace App\Models;

use App\Models\PostPicture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'post_body',
        'feeling_id',
        'user_id',

        'is_active',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
    ];


    public function post_user(){
        return $this->belongsTo(User::class, "user_id");
    }

    // how can we see a picture or fetch a picture name.
    // 1st posts ,
    // 2nd post_pictures,
    // 3rd pictures
    // that means multiple table we have to join , thats why we have to use belongsToMany();


    public function post_pictures(){
        return $this->hasMany(PostPicture::class);
    }

    public function pictures(){
        return $this->hasManyThrough(Picture::class,PostPicture::class,'post_id','id', 'id', 'picture_id');
        // post_id = foreign key post_pictures table
        // id  = local key of posts table
        // id  = local key of post_pictures table
        // picture_id = foreign key of post_pictures table
    }

    public function post_comments(){
        return $this->hasMany(PostComment::class, 'post_id', 'id');
    }

    public function scopeUserId($query, $user_id){
        $query->where('user_id', $user_id);
    }

    public function scopePostId($query, $post_id){
        $query->where('id',$post_id);
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class, 'post_id');
    }



}
