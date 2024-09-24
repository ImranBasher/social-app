<?php 

namespace App\Services;

use App\Models\User;

class UserDataFetcher
{
    public function getAll_( $paginatePluckOrGet = null, $onlyParents = null, $onlyActive = null, array $relationships = [], array $options = [], $id = null ) {

        // $query = Category::query()->withCount("id")->with(["localizations"=>function($query){
        //         $query->select('id', 'category_name')->where("id",$id);
        //     }]);


        
        $query = User::query(); 
        // Bind Relationships
        //  !empty($relationships) ? $query->with($relationships) : $query->with(['user', 'createdBy', 'updatedBy', 'category', 'products']);
         !empty($relationships) ? $query->with($relationships) : $query->with([]);
        $query->latest();

        // Active in-active
        if (!is_null($onlyActive)) {
            // Only active categories or not active categories
            $query->where("is_active",$onlyActive);
        }

        // Pluck Data Returning
        if (is_null($paginatePluckOrGet)) {
            return $query->pluck("id", "name");
        }

        return $paginatePluckOrGet ? $query->paginate(5) : $query->get();
    }


}