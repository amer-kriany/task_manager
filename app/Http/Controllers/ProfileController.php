<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Profile::all();
        return ProfileResource::collection($profiles)->response()->setStatusCode(200);

    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)

    {
        $validated=$request->validated();
        $profile=Profile::create($validated);
        return (new ProfileResource($profile))->response()->setStatusCode(201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $profile=Profile::findOrFail($id);
        return (new ProfileResource($profile))->response()->setStatusCode(200);
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request,$id)
    {
        $validated=$request->validated();
        $profile=Profile::findOrFail($id);
        $profile->update($validated);
        return (new ProfileResource($profile))->response()->setStatusCode(200);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $profile=Profile::findOrFail($id);
        $profile->delete();
        return response()->noContent();
        
    }
}
