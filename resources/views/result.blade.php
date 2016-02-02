@extends('head')

@section('content')

<script>
    $(document).ready(function(){
        $('body').css('background', '#fff');
    });
</script>
<div class="result">
    <div style="float: left; margin: 10px">
        {{--<a href="storage/excel/exports/mail_adress_{{ $number_generate }}.xlsx" class="btn btn-primary">Почтовые адреса</a>--}}
        {{--<a href="storage/excel/exports/full_list_{{ $number_generate }}.xlsx" class="btn btn-primary">Полный</a>--}}
        {{--<a href="storage/excel/exports/summary_list_{{ $number_generate }}.xlsx" class="btn btn-primary">Краткий</a>--}}
        <a href="{{ action('UserController@resultSummary') }}"> Краткий </a>
        <a href="{{ action('UserController@resultFull') }}"> Полный </a>
        <a href="{{ action('UserController@resultMailAdress') }}"> Почтовые адреса </a>
    </div>

    <table class="table table-hover table-striped table-bordered table-condensed">
        <tr>
            <td>Регион</td>
            <td>Город</td>
            <td>Название Церкви</td>
            <td>ФИО главного служителя</td>
            <td>Количество членов церкви</td>
        </tr>

        @foreach($churches as $c)
            <tr>
                <td>{{ $c->region }}</td>
                <td>{{ $c->village }}</td>
                <td>{{ $c->title }}</td>
                <td>{{ $c->servant_name }}</td>
                <td>{{ $c->members + $c->children }}</td>
            </tr>
        @endforeach

    </table>
</div>

@stop