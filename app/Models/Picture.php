<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'pic_name',
        'is_active',

        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
    ];

    public function postPictures(){
        return $this->hasMany(PostPicture::class);
    }

    // want to collect all picture of post according to user_id
//    public function postPicturesCreatedBy(){
//        return $this->hasMany(PostPicture::class,'user_id');
//    }
}

