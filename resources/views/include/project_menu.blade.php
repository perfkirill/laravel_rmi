<ul class="project_menu">
    <li>Тариф {{auth()->user()->role}}</li>
    <li><a href="{{ URL::route("tasks",$project_info['0']->id) }}">Задачи по проекту</a></li>
    <li><a href="{{ URL::route("semanticСores",$project_info['0']->id) }}">Семантическое ядро</a></li>
    <li><a href="{{ URL::route("googleapi", $project_info['0']->id) }}">Google API</a></li>
    <li><a href="{{ URL::route("minusGenerator",  $project_info['0']->id)}}">Генератор минус слов</a></li>
</ul>
