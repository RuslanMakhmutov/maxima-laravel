<form action="{{ empty($task) ? route('tasks.store') : route('tasks.update', $task) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if (!empty($task))
        @method('PUT')
    @endif

    <p><input type="text" name="title" value="{{ $task->title ?? '' }}" placeholder="Название задачи"></p>
    <p><textarea name="description" placeholder="Описание задачи">{{ $task->description ?? '' }}</textarea></p>

    <p>
        @if(!empty($task->image))
            <img src="{{ Storage::url($task->image) }}" alt="{{ $task->title }}" width="100">
            <input type="checkbox" name="delete_image" value="1"> Удалить изображение?<br>
        @endif
    </p>
    <p><input type="file" name="image"></p>

    <p><button type="submit">{{ empty($task) ? 'Создать' : 'Обновить' }}</button></p>
</form>
