<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckTaskOwner;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware([CheckTaskOwner::class])->only(['update', 'destroy']);
    }

    public function index()
    {
        return response()->json(['data' => Task::all()]);
    }

    public function store(TaskStoreRequest $request)
    {
        try {
            $validated = $request->validated();

            return Task::create(['user_id' => auth()->user()->id, 'title' => $validated['title'], 'description' => $validated['description']])
                ? response()->json(['message' => 'Task created with successfully'], 201)
                : response()->json(['error' => 'Upps!! I cannot create the task, try again'], 500);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function show(Task $task)
    {
        return response()->json(['data' => $task]);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        try {
            return $task->update($request->validated())
                ? response()->json(['message' => 'Task updated successfully'], 200)
                : response()->json(['message' => 'Failed updated Task!'], 500);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(['error' => 'Failed to update task. Please try again.'], 500);
        }
    }

    public function destroy(Task $task)
    {
        try {
            return $task->delete()
                ? response()->json(['message' => 'Task deleted successfully'], 200)
                : response()->json(['message' => 'Failed deleted Task!'], 500);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(['error' => 'Failed to deleted task. Please try again.'], 500);
        }
    }
}
