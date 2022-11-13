<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Создание кластера семантики для "{{$project_info['0']->name}}"
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="dashboard_header">

                        <a href="{{ URL::route("projects") }}">Все проекты</a>
                    </div>


                    <div class="dashboard_content_wrap">
                        <div class="dashboard_content_menu">
                            @include('include.project_menu')
                        </div>
                        <div class="dashboard_content ">

                            <div class="semantic_core_errors">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <form method="POST" action="{{ URL::route("semanticСoresStore",$project_info['0']->id) }}">
                                @csrf

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Название семантического ядра
                                    </label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="category_name" name="category_name" type="text" placeholder="">
                                </div>

                                <button type="submit" class="ui_button">Создать</button>

                            </form>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
