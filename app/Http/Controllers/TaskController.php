<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\TaskService;

class TaskController extends Controller
{
    public function index(TaskService $taskService)
    {
        return $taskService->index();
    }

    public function create()
    {
        return view('tasks.add');
    }

    public function store(StoreTaskRequest $request, TaskService $taskService)
    {
        return $taskService->store($request);
    }

    public function show(Task $task, TaskService $taskService)
    {
        return $taskService->show($task);
    }

    public function edit(Task $task, TaskService $taskService)
    {
        return $taskService->edit($task);
    }

    public function update(UpdateTaskRequest $request, Task $task, TaskService $taskService)
    {
        return $taskService->update($task, $request);
    }

    public function destroy(Task $task, TaskService $taskService)
    {
        return $taskService->destroy($task);
    }
}
