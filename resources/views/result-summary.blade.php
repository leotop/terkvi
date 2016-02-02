@extends('head')

@section('content')

    <script>
        $(document).ready(function(){
            $('body').css('background', '#fff');
        });
    </script>
    <div class="result">
        <div style="float: left; margin: 10px">
            <a href="{{ action('UserController@resultSummary') }}" class="btn btn-primary"> Краткий </a>
            <a href="{{ action('UserController@resultFull') }}" class="btn btn-primary"> Полный </a>
            <a href="{{ action('UserController@resultMailAdress') }}" class="btn btn-primary"> Почтовые адреса </a>
            <a href="storage/excel/exports/summary_list_{{ session('number_generate') }}.xlsx" class="btn btn-success"> Скачать excel </a>
        </div>
        <div class="pull-right">
            <a href="home" class="btn btn-primary">На главную страницу</a>
        </div>

        <table class="table table-hover table-striped table-bordered table-condensed">
            <tr>
                <td style="width: 95px"></td>
                <td>Регион</td>
                <td>Город</td>
                <td>Название Церкви</td>
                <td>ФИО главного служителя</td>
                <td>Количество членов церкви</td>
                <td>Создан</td>
                <td>Обновлён</td>
                <td style="width: 95px"></td>
            </tr>

            @if(isset($id_modify))
                <form action="result-summary" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="wi-ma" style="margin-bottom: 25px">
                        <br><br><br><br><br>
                        <div class="dib" style="width: 200px; line-height: 34px; text-align: right;">
                            Регион
                            <br>Город
                            <br>Название Церкви
                            <br>ФИО главного служителя
                            <br>Количество членов церкви
                            <br>Количество детей
                        </div>
                        <div class="dib" style="width: 600px">
                            <input type="text" class="form-control" name="region" value="{{ $modify_position->region }}">
                            <input type="text" class="form-control" name="village" value="{{ $modify_position->village }}">
                            <input type="text" class="form-control" name="title" value="{{ $modify_position->title }}">
                            <input type="text" class="form-control" name="servant_name" value="{{ $modify_position->servant_name }}">
                            <input type="text" class="form-control" name="members" value="{{ $modify_position->members }}">
                            <input type="text" class="form-control" name="children" value="{{ $modify_position->children }}">
                        </div>
                        <br><br>
                        <center>
                            <input type="submit" name="save_change" value="Сохранить" class="btn btn-primary">
                        </center>
                    </div>
                </form>
            @endif

            @foreach($churches as $c)
                <tr>
                    <td>
                        <form action="result-summary" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_table" value="{{ $c->id }}">
                            <i class="fa fa-pencil"></i>
                            <input type="submit" name="modify" value="Изменить" class="btn btn-success btn-xs">
                        </form>
                    </td>
                    <td>{{ $c->region }}</td>
                    <td>{{ $c->village }}</td>
                    <td>{{ $c->title }}</td>
                    <td>{{ $c->servant_name }}</td>
                    <td>{{ $c->members + $c->children }}</td>
                    <td>{{ $c->created_at }}</td>
                    <td>{{ $c->updated_at }}</td>
                    <td>
                        <form action="result-summary" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_table" value="{{ $c->id }}">
                            <i class="fa fa-remove"></i>
                            <input type="submit" name="delete" value="Удалить" class="btn btn-danger btn-xs">
                        </form>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>

@stop