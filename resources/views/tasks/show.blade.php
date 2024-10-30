@extends('layouts.app')

@section('content')
    <h1>{{ $task->title }}</h1>

    <p>{{ $task->description }}</p>

    @if(!empty($task->image))
        <a href="{{ Storage::url($task->image) }}" target="_blank">
            <img src="{{ Storage::url($task->image) }}" alt="{{ $task->title }}" width="400">
        </a>
    @endif

    <div><a href="{{ route('tasks.edit', $task) }}">Редактировать</a></div>
    <div style="margin-top: 1em;">
        <form action="{{ route('tasks.destroy', $task) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">Удалить</button>
        </form>
    </div>
@endsection
