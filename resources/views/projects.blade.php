<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Проекты
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="projects_button_new">
                        <a href="{{ URL::route("createProjects") }}">
                            <button class="btn btn-blue ui_button">Создать проект</button>
                        </a>
                    </div>

                    <div class="project_list">

                        @if($user_projects)
                            <ul>
                                @foreach ($user_projects as $user_projects)

                                    <li>
                                        <a href="{{ URL::route("showProjects",$user_projects->id) }}">{{ $user_projects->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
