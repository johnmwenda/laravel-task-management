<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\Api\CreateTask;
use App\Task;
use App\TaskManagement\Filters\TaskFilter;
use App\TaskManagement\Paginate\Paginate;
use App\TaskManagement\Transformers\TaskTransformer;

class TaskController extends ApiController
{
    /**
     * TaskController constructor.
     *
     * @param TaskTransformer $transformer
     */
    public function __construct(TaskTransformer $transformer)
    {
        $this->transformer = $transformer;


        // $this->middleware('auth.api')->except(['index', 'show']);
        // $this->middleware('auth.api:optional')->only(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TaskFilter $filter)
    {
        $tasks = new Paginate(Task::loadRelations()->filter($filter));

        return $this->respondWithPagination($tasks);
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
    public function store(CreateTask $request)
    {   
        // $user = auth()->user();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
