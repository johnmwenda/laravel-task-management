<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\Api\CreateProgress;
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


        $this->middleware('auth.api')->except(['index', 'show']);
        $this->middleware('auth.api:optional')->only(['index', 'show']);
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
        $user = auth()->user();
        // dd( auth()->id() );
        

        // dd($request->input('task') );
        // dd('hello store');
        
        // dd($request->input('task.notify') );
        $who_to_notify = $request->input('task.notify');
        if(! empty($who_to_notify['departments'] )) {
            // dd($who_to_notify['departments']);
            $department_subscribers = $who_to_notify['departments'];
        }else {
            $department_subscribers = null;
        }

        if(! empty($who_to_notify['members'] )) {
            // dd($who_to_notify['members']);
            $user_subscribers = $who_to_notify['members'];
        }else {
            $user_subscribers = null;
        }



// user_subscribers

        $task = $user->create_task([
            'user_id' => auth()->id(),
            'department_id' => $user->department_id,
            'category_id' => $request->input('task.category_id'),
            'assignee_id' => $request->input('task.assignee_id'),
            'name' => $request->input('task.name'),
            'summary' => $request->input('task.summary'),
            'access_level' => $request->input('task.access_level'),
            'priority' => $request->input('task.priority'),
            'due_date' => $request->input('task.due_date')
        ], $department_subscribers, $user_subscribers);

        return $this->respondWithTransformer($task);
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

    /**
     * add progress status and message to a task
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function addProgressStatus(CreateProgress $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->addProgressStatus([
            // 'body' => request('body'),
            'user_id' => auth()->id(),
            'overall_status' => $request->input('progress.overall_status'),
            'message' => $request->input('progress.message'),
            'progress_status' => $request->input('progress.progress_status'),
        ]);

    }

    /**
     * get only the tasks belonging to the currently authenticated user, also we parse the different filters
     * 1. reportedbyMe
     * 2. assignedToMe
     * 3. private
     * 4. public
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function authenticatedUserTasks(TaskFilter $filter)
    {
        $tasks = new Paginate(Task::loadRelations()->filter($filter));

        return $this->respondWithPagination($tasks);
    }


}


// task_id [url]
// user_id [auth]
// overall_status
// message
// progress_status