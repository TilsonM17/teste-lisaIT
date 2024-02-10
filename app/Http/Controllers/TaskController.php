<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{

    public function index()
    {
        return response()->json(['data' => Task::all()]);
    }


    public function store(TaskStoreRequest $request)
    {
        try {
            $validated = $request->validated();
            return Task::create(['user_id' => auth()->user()->id, 'title' => $validated['title'], 'description' => $validated['description'],])
                ? response()->json(status: 201)
                : response()->json(['error' => 'Upps!! I cannot create the task, try again'], 500);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    
    public function show(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
