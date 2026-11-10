<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Task;

class CategoryController extends Controller
{










    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
        return  CategoryResource::collection($categories)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
     $validated=$request->validated();
     $category=Category::create($validated);
     return (new CategoryResource($category))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category=Category::findOrFail($id);
        return (new CategoryResource($category))->response()->setStatusCode(200);
    }

 

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request,  $id)
    {
        $validated=$request->validated();
        $category=Category::update($validated);
        return (new CategoryResource($category))->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category=Category::delete($id);
        return response()->noContent();
    }
}
