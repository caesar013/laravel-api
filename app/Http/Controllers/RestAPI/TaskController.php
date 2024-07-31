<?php

namespace App\Http\Controllers\RestAPI;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return TaskResource::collection(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        //
        $task = new Task();
        $task->fill($request->validated());
        $task->save();

        if ($task) {
            # code...
            return new TaskResource($task);
        }
        return response()->json(['message' => 'Task creation failed'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
        if ($task) {
            # code...
            return TaskResource::make($task);
        }
        return response()->json(['message' => 'Task not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
        if ($task) {
            # code...
            $task->update($request->validated());

            return TaskResource::make($task);
        }
        return response()->json(['message' => 'Task not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        if ($task) {
            # code...
            $task->delete();

            return response()->json(['message' => 'Task deleted successfully'], 200);
        }
        return response()->json(['message' => 'Task not found'], 404);
    }
}
