<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Задачи по проекту  "{{$project_info['0']->name}}"
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                    <div class="dashboard_content_wrap">
                        <div class="dashboard_content_menu">
                            @include('include.project_menu')
                        </div>
                        <div class="dashboard_content ">

                            <div class="dashboard_content_tasks">

                                <div class="dashboard_content_task_new">
                                    <form action="{{ URL::route("storeTask",$project_info['0']->id) }}" method="post">


                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        @csrf
                                        <div class="dashboard_content_task_new_form">
                                        <div class="">
                                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                                Новая задача
                                            </label>
                                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="title" type="text" placeholder="new task">
                                        </div>
                                            <div class="">
                                                <label class="block text-gray-700 text-sm font-bold mb-2" for="deadline">
                                                    Дедлайн
                                                </label>
                                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="deadline_date" type="date" placeholder="new task">
                                            </div>
                                        <div class="">
                                            <button type="submit" class="ui_button">Создать Задачу</button>

                                        </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="dashboard_content_tasks_list">
                                @if(count($project_tasks))
                                <ul>
                                    @foreach($project_tasks as $project_task)

                                        <li>{{$project_task->title}} <span><form action="{{ URL::route("TaskComplete",[$project_info['0']->id,$project_task->id] )}}" method="post"> @csrf  <input type="hidden" name="_method" value="PUT">  <button>Выполнено</button> </form></span></li>

                                    @endforeach
                                </ul>
                                @else
                                    Задач еще нет
                                @endif
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
