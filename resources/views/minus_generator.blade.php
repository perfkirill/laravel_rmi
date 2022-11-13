<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Генератор минус слов
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="post" action="{{ URL::route("minusGeneratorProcess") }}">
                        @csrf
                        <div class=" grid grid-rows-2">
                            <div class="col-md-6">
                                <h2>Вставьте текст с минус словами</h2>
                                <textarea name="minus_text" id="" cols="30" style='width:100%' rows="10"></textarea><br>
                            </div>
                            <div class="col-md-6">
                                <h2>Вставьте текст фразами</h2>
                                <textarea name="plus_text" id="" cols="30" style='width:100%' rows="10"></textarea><br>
                            </div>
                        </div>
                        <input type="submit">



                    </form>


                    @if($minus_keys)

                        <h2>Результат</h2><br><textarea  cols="30" style='width:80%' rows="10">{{$minus_keys}}</textarea>

                    @endif


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
