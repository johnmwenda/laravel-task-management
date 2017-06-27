<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\TaskManagement\Transformers\CategoryTransformer;
// use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    public function __construct(CategoryTransformer $transformer)
    {
        $this->transformer = $transformer;
        // $this->middleware(['auth', 'category']);
            // ->except('index', 'show');
            // 
        $this->middleware('auth.api')->except(['index', 'show']);
        $this->middleware('auth.api:optional')->only(['index', 'show']);
    }
    /**
     * Display a listing of all categories will include filters such as ...
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    //Check department_id must be an integer
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:100',
            'description' =>'required|max:100',
            'department_id' =>'required'
            ]);

        $category = Category::create([
                'name' => request('name'),
                'description' => request('description'),
                'department_id' => request('department_id')
            ]);

        // $category = Category::create([$request->only('name','description','department_id')]);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    /**
     * get task categories for the logged in user... used in creating a task
     * @return [type] [description]
     */
    public function getTaskCategoriesForLoggedInUser(){
        $user = auth()->user();

        dd($user);

        $categories = Category::where('department_id', $user->department_id );

        return respondWithTransformer($categories);
    }
}
