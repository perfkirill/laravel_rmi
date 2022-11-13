<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Google API отправка страниц
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
                        <div class="dashboard_content content">
                            <div class="google_api_form">

                                <form action="{{ URL::route("googleapistore",$project_info[0]->id) }}" method="post">
                                    @csrf
                                    <div class="google_api_form_title">Добавить все URL в Базу</div>
                                    <div class="google_api_form_textarea"><textarea name="urls_to_db" class="" id="" cols="30" rows="10"></textarea></div>
                                    <button class="ui_button">Добавить</button>
                                </form>
                            </div>


                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
                                  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
                            <title>Indexing API</title>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                            <div class="container pt-3" style="max-width: 1400px;">
                                <div class="">
                                    <div class="google_api_form_title">Добавить URL на отправку</div>
                                    <label for="url" class="form-label">URL</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="url" value="">

                                        <button class="btn btn-secondary" type="button" id="get-status">Получить статус</button>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <div>
                                        <textarea name="" style="width:100%; white-space: pre-wrap;" id="urls" cols="30" rows="10">@foreach($urls as $url){{($url->url."\n")}}@endforeach</textarea>
                                    </div>

                                    <div>Всего ссылок: {{$urls_counter}}</div>
                                    <button type="button" class="btn btn-primary" id="updateArray">Массовое Обновление URL</button>
                                    <button type="button" class="btn btn-primary" id="update">Обновление URL</button>
                                    <button type="button" class="btn btn-danger" id="delete">Удаление URL</button>
                                </div>
                                <div class="alert alert-info">
                                    <h4>Результат:</h4>
                                    <div id="result">...</div>
                                </div>
                            </div>


                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                                    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                                    crossorigin="anonymous"></script>
                            <script src="{{ asset('google-index-service/js/main.js') }}"></script>


                            <script>

                                $( "#updateArray" ).click(function() {

                                    var urls_str = $("#urls").val();
                                    var urls_str_arr = urls_str.split('\n');
                                    //alert(urls_str_arr[2]);

                                    console.log(urls_str_arr.length);

                                    for (let i = 0; i < urls_str_arr.length; i++) { // выведет 0, затем 1, затем 2
                                        $.ajax({
                                            url: '{{URL::route("googleapimassindex",$project_info['0']->id)}}',         /* Куда пойдет запрос */
                                            method: 'post',             /* Метод передачи (post или get) */
                                            dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            data: {url: urls_str_arr[i]},     /* Параметры передаваемые в запросе. */
                                            success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
                                                //alert(data);            /* В переменной data содержится ответ от index.php. */
                                                // var obj = JSON.parse(data);
                                                $("#result").append("<pre class=\"mb-0\">" + data + "</pre>");

                                            }
                                        });
                                    }



                                });



                            </script>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
