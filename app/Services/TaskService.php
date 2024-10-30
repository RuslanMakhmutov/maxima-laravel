<?php

namespace App\Services;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class TaskService
{

    public function index()
    {
        return view('tasks.index', [
            'tasks' => Task::all(),
        ]);
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $task = Task::create($request->validated());

        if ($request->hasFile('image')) {
            $task->image = Storage::putFile(Task::IMAGE_PATH, $request->file('image'));
            $task->save();
        }

        return redirect()->route('tasks.show', $task);
    }

    public function update(Task $task, UpdateTaskRequest $request): RedirectResponse
    {
        $task->update($request->validated());

        // удаление старого файла, если передали новый файл просто попросили удалить файл
        if ($request->hasFile('image') || $request->has('delete_image')) {
            $task->deleteImage();
        }
        if ($request->hasFile('image')) {
            $task->image = Storage::putFile(Task::IMAGE_PATH, $request->file('image'));
        }
        $task->save();

        return redirect()->route('tasks.show', $task);
    }

    public function show(Task $task)
    {
        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }


    public function destroy(Task $task): RedirectResponse
    {
        $task->deleteImage();
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
