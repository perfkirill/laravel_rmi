<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Семантическое ядро "{{$project_info['0']->name}} " Категория {{$semantic_core_info['category_name']}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="dashboard_header">


                    </div>


                    <div class="dashboard_content_wrap">
                        <div class="dashboard_content_menu">

                            @include('include.project_menu')

                        </div>
                        <div class="dashboard_content content">

                            <a href="{{ URL::route("semanticСoreKeysExport",[$semantic_core_id]) }}"><button class="ui_button">Выгрузить в EXCEL</button></a>

                            <div class="seo_keys_inser_form">
                                <form action="{{ URL::route("storeSemanticKeys",[$project_info['0']->id,$semantic_core_id]) }}" method="post">
                                    @csrf

                                    <div class="seo_keys_inser_form_block">
                                        <div class="seo_keys_inser_form_block_title">Тип</div>
                                        <select name="type" class="seo_keys_inser_form_textarea" id="">
                                            <option value="1">Ключевые слова</option>
                                            <option value="0">Минус слова</option>
                                        </select>
                                    </div>

                                    <div class="seo_keys_inser_form_block">
                                        <div class="seo_keys_inser_form_block_title">Ключевые слова</div>
                                    <textarea name="keys" id="" class="seo_keys_inser_form_textarea" cols="30" rows="5"></textarea>
                                    </div>

                                    <button class="ui_button seo_keys_inser_form_button">Сохранить</button>
                                </form>
                            </div>


                            <div class="seo_keys_error">
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

                            <div class="seo_keys_table">
                                <h2>Ключевые слова</h2>
                                <table>
                                    <thead>
                                    <tr>


                                    <td>Ключ</td>
                                    <td>Действия</td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($semantic_core_keys as $semantic_core_key)
                                            @if($semantic_core_key['type'])
                                            <tr>
                                            <td>{{$semantic_core_key['name']}}</td>
                                            <td><a href="{{ URL::route("semanticСoreKeyDelete",[$project_info['0']->id, $semantic_core_id, $semantic_core_key['id']])}}">Удалить</a></td>
                                            </tr>
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>




                            <div class="seo_keys_table">
                                <h2>Минус слова</h2>
                                <table>
                                    <thead>
                                    <tr>


                                        <td>Ключ</td>
                                        <td>Действия</td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($semantic_core_keys as $semantic_core_key)
                                        @if(!$semantic_core_key['type'])
                                            <tr>
                                                <td>{{$semantic_core_key['name']}}</td>
                                                <td><a href="{{ URL::route("semanticСoreKeyDelete",[$project_info['0']->id, $semantic_core_id, $semantic_core_key['id']])}}">Удалить</a></td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <div class="" style="text-align: left;">

                                <ul>

                                </ul>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
