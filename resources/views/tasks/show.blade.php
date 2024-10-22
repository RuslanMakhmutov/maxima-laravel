@extends('layouts.app')

@section('content')
    <h1>{{ $task->title }}</h1>

    <p>{{ $task->description }}</p>

    <div><a href="{{ route('tasks.edit', $task) }}">Редактировать</a></div>
    <div style="margin-top: 1em;">
        <form action="{{ route('tasks.destroy', $task) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">Удалить</button>
        </form>
    </div>
@endsection
