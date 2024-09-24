<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Trait\FileUpload;
use Illuminate\Http\Request;
use App\Services\IsActive;
use App\Services\PictureDataFetcher;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePictureData;

class PictureController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = new PictureDataFetcher();

        $pictures['pictures'] = $data->getAll_(true);
        return view('admin.pictures.index')->with($pictures);
    }

    public function create(){

        return view('admin.pictures.add_picture');
    }

    public function store(StorePictureData $request){

        $picture = $request->validated();
        $picture['created_by_id'] = Auth::id();
        $picture['is_active'] = (new IsActive())->is_active($picture['is_active']);
        
        // dd($request);

        if($request->hasFile('pic_name')){

            $filename = $this->fileUploder($request->pic_name);

            $picture['pic_name'] = $filename;

            Picture::create($picture);

            session()->flash('sussecc', 'Successfully updated a image');
            return redirect()->route('pictures.index');
        }


            return view('admin.pictures.add_picture');

    }

    public function edit(Picture $picture)
    {
        $picture['picture'] = $picture->get();
        // $picture_id = Picture::findOrFail($id);

        return view('admin.pictures.edit_picture')->with($picture);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePictureData $request, Picture $picture)
    {
        $picture_id = $picture->get();
        $picture = $request->validated();
        $picture['updated_by_id'] = Auth::id();

        if($request->hasFile('pic_name')){

            $filename = $this->fileUploder($request->pic_name);

            $picture['pic_name'] = $filename;

            Picture::create($picture);
            
            session()->flash('sussecc', 'Successfully updated a image');
            return redirect()->route('pictures.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Picture $picture)
    {
        $picture_id = $picture->get();

        $picture_id->delete();

        session()->flash('sussecc', 'Successfully delete a image');
        return redirect()->route('pictures.index');

    }
}
