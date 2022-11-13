<h2>Добрый день, у вас есть задачи, которые истекают сегодня</h2>
<br>
@foreach($tasks_info as $task)

<p>{{$task['task']}} - у проекта {{$task['project']}}</p>

@endforeach
