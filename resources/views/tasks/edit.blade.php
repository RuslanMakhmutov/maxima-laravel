@extends('layouts.app')

@section('content')
    <h1>Редактирование задачи</h1>

    @include('tasks.form', ['task' => $task])
@endsection
