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
            <a href="storage/excel/exports/mail_adress_{{ session('number_generate') }}.xlsx" class="btn btn-success"> Скачать excel </a>
        </div>
        <div class="pull-right">
            <a href="home" class="btn btn-primary">На главную страницу</a>
        </div>

        <table class="table table-hover table-striped table-bordered table-condensed">
            <tr>
                <td style="width: 95px"></td>
                <td>Название Церкви</td>
                <td>ФИО получателя</td>
                <td>Улица, номер дома, квартира</td>
                <td>Индекс</td>
                <td>Нас. Пункт</td>
                <td>Страна</td>
                <td>Создан</td>
                <td>Обновлён</td>
                <td style="width: 95px"></td>
            </tr>

            @if(isset($id_modify))
                <form action="result-mail-adress" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="wi-ma" style="margin-bottom: 25px">
                        <br><br><br><br><br>
                        <div class="dib" style="width: 200px; line-height: 34px; text-align: right;">
                            Название Церкви
                            <br>ФИО получателя
                            <br>Улица
                            <br>Номер
                            <br>Квартира
                            <br>Индекс
                            <br>Нас. Пункт
                        </div>
                        <div class="dib" style="width: 600px">
                            <input type="text" class="form-control" name="title" value="{{ $modify_position->title }}">
                            <input type="text" class="form-control" name="servant_name" value="{{ $modify_position->servant_name }}">
                            <input type="text" class="form-control" name="servant_street" value="{{ $modify_position->servant_street }}">
                            <input type="text" class="form-control" name="servant_servant_umber" value="{{ $modify_position->servant_number }}">
                            <input type="text" class="form-control" name="servant_apartment" value="{{ $modify_position->servant_apartment }}">
                            <input type="text" class="form-control" name="servant_index" value="{{ $modify_position->servant_index }}">
                            <input type="text" class="form-control" name="servant_village" value="{{ $modify_position->servant_village }}">
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
                        <form action="result-mail-adress" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_table" value="{{ $c->id }}">
                            <i class="fa fa-pencil"></i>
                            <input type="submit" name="modify" value="Изменить" class="btn btn-success btn-xs">
                        </form>
                    </td>
                    <td>{{ $c->title }}</td>
                    <td>{{ $c->servant_name }}</td>
                    <td>{{ $c->servant_street.' '.$c->servant_number.' '.$c->servant_apartment }}</td>
                    <td>{{ $c->servant_index }}</td>
                    <td>{{ $c->servant_village }}</td>
                    <td>{{ $c->country }}</td>
                    <td>{{ $c->created_at }}</td>
                    <td>{{ $c->updated_at }}</td>
                    <td>
                        <form action="result-mail-adress" method="POST">
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