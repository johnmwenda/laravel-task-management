<?php

namespace App\Http\Controllers\Api;

use App\Department;
use App\TaskManagement\Transformers\DepartmentTransformer;

// use Illuminate\Http\Request;

class DepartmentController extends ApiController
{	

	public function __construct(DepartmentTransformer $transformer)
    {
        $this->transformer = $transformer;
        // $this->middleware(['auth', 'category']);
            // ->except('index', 'show');
            // 
        // $this->middleware('auth.api')->except(['index', 'show']);
        // $this->middleware('auth.api:optional')->only(['index', 'show']);

		$this->middleware('auth.api');
    }

    //get all  departments
    public function index(){
        // dd('called');

    	$departments = Department::loadUserRelations()->get();

    	return $this->respondWithTransformer($departments);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
