<?php

namespace App\Http\Controllers;
use App\Models\Feeling;
use App\Services\IsActive;
use Illuminate\Http\Request;
use App\Services\FeelingDataFetcher;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFeelingRequest;

class FeelingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =  new FeelingDataFetcher();

        $feelings['feelings'] =  $data->getAll_(true);

        // $feelings['feelings'] =( new DataFetcher())->getAll_(true);

        return view("admin.feelings.index")->with($feelings);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.feelings.add_feeling');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeelingRequest $request)
    {
        $feeling = $request->validated();

        $feeling['is_active'] = (new IsActive())->is_active($feeling['is_active']);

        $feeling['created_by_id'] = Auth::id();

        Feeling::create($feeling);

        session()->flash('success', 'A feeling name add successfully');
        return redirect()->route('feelings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feeling $feeling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $feeling['feeling'] = Feeling::findOrFail($id);
        return view('admin.feelings.edit_feeling')->with($feeling);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFeelingRequest $request, $id)
    {
        $feeling_id = Feeling::findOrFail($id);

        $feeling = $request->validated();

        $feeling['is_active'] = (new IsActive())->is_active($feeling['is_active']);

        $feeling['updated_by_id'] = Auth::id();

        $feeling_id->update($feeling);
      
        session()->flash('success', 'According to id a feeling name update successfully');    // you have show this message in index file
        return redirect()->route('feelings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $feeling_id = Feeling::findOrFail($id);

        $feeling_id->delete();

        session()->flash('message', 'A Feeling delete succefully');
        return redirect()->route('fellings.index');
    }
}


