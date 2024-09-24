<?php


namespace App\Services\Models\User;
use App\Models\User;
class UserService1{

    public function getAll_(
        $paginatePluckOrGet = null,
        $onlyParents = null,
        $onlyActive = null,
        array $relationships = [],
        array $options = [],
        $id = null
    )
    {
    $query = User::query();

    !empty($relationships) ? $query->with($relationships) : $query->with(['Friend']);

    $query->latest();

    if (!is_null($onlyActive)) {
        $query->where("is_active",$onlyActive);
    }

    if (is_null($paginatePluckOrGet)) {
        return $query->pluck("id", "name");
    }

    return $paginatePluckOrGet ? $query->where('user_type', 3)->where('id', '!=', userId())->paginate(50) : $query->where('user_type', 3)->get();
}



public function allfriendRequest(){
    User::distinct()->JOIN('friends', function($join){
       $join->on('users.id','=','friends.to_user')->orOn('users.id', '=', 'friends.from_user');
    })
    ->where(function($query){
        $query->where('friends.to_user', userId())->orWhere('friends.from_user', userId());
    })->get();
}
}
