@extends('layouts.app')

@section('content')
    <h1>Главная страница</h1>

    <div><a href="{{ route('tasks.index') }}">Задачи</a></div>
@endsection
