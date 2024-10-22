<form action="{{ empty($task) ? route('tasks.store') : route('tasks.update', $task) }}" method="POST">
    @csrf
    @if (!empty($task))
        @method('PUT')
    @endif

    <p><input type="text" name="title" value="{{ $task->title ?? '' }}" placeholder="Название задачи"></p>
    <p><textarea name="description" placeholder="Описание задачи">{{ $task->description ?? '' }}</textarea></p>
    <p><button type="submit">{{ empty($task) ? 'Создать' : 'Обновить' }}</button></p>
</form>
