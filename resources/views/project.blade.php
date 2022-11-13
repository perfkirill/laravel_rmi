<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Проект "{{$project_info['0']->name}}"
        </h2>
        <div class="dashboard_header_links">
            <a href="{{ URL::route("editProject",$project_info['0']->id) }}">Редактировать</a>
            <a href="{{ URL::route("deleteProject",$project_info['0']->id) }}">Удалить</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">




                    <div class="dashboard_content_wrap">
                        <div class="dashboard_content_menu">
                            @include('include.project_menu')
                        </div>
                        <div class="dashboard_content content">
                            Выберите нужнуй функционал по проекту
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
