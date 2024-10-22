@extends('layouts.app')

@section('content')
    <h1>Список задач</h1>
    @foreach ($tasks as $task)
        <div class="mb-4">
            <a href="/tasks/{{ $task->id }}">
                {{ $task->title }}
            </a>
        </div>
    @endforeach

    <div style="margin-top: 3em;"><a href="{{ route('tasks.create') }}">Создать задачу</a></div>
@endsection
