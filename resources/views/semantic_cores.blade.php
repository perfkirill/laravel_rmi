<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Семантическое ядро "{{$project_info['0']->name}}"
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

                            <div class="dashboard_content_button"><a
                                    href="{{URL::route("semanticСoresCreate",$project_info['0']->id)}}">
                                    <button class="ui_button">Новый кластер</button>
                                        </a></div>

                            <div class="dashboard_content_items">

                                <ul>
                                    @foreach($semantic_cores as $semantic_core)

                                        <li>
                                            <a href='{{URL::route("semanticСoreKeys",[$project_info['0']->id,$semantic_core['id']]) }}'>{{$semantic_core['category_name']}}
                                                ({{$semantic_core->seoKeysCount() }})</a></li>




                                        @foreach($semantic_core->seokeys as $seokey_arr)

                                            {{$seokey_arr->name}},


                                        @endforeach


                                    @endforeach
                                </ul>


                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
