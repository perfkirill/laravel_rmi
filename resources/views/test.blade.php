@extends("layouts.test")

@section('title', 'Test view page')
@section('sidebar', 'some sidebar')


@section("content")
<?php
print_r($post);
?>

    <form action="{{route("testFormPiker",4)}}" method="post">
        @csrf
        <input type="text" name="num" value="@isset($req_summ){{$req_summ}}@endif">
        <button>Отправить</button>
    </form>

@endsection
