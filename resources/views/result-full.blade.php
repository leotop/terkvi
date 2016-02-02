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
            <a href="storage/excel/exports/full_list_{{ session('number_generate') }}.xlsx" class="btn btn-success"> Скачать excel </a>
        </div>
        <div class="pull-right">
            <a href="home" class="btn btn-primary">На главную страницу</a>
        </div>

        <table class="table table-hover table-striped table-bordered table-condensed">
            <tr>
                <td style="width: 95px"></td>
                <td>Нас. Пункт</td>
                <td>Название церкви</td>
                <td>Общее</td>
                <td>Детей</td>
                <td>Улица, номер, дом, квартира</td>
                <td>Индекс</td>
                <td>Район</td>
                <td>Телефон</td>
                <td>эл. Почта</td>
                <td>веб страница</td>
                <td>другие</td>
                <td>Служение</td>
                <td>Дата пукоположения</td>
                <td>Кто рукопологал</td>
                <td>Телефон</td>
                <td>Мобильный</td>
                <td>эл. почта</td>
                <td>улица, номер, дом квартира</td>
                <td>индекс</td>
                <td>нас.пункт</td>
                <td>район</td>
                <td>дополнительная информация</td>
                <td>Создан</td>
                <td>Обновлён</td>
                <td style="width: 100px"></td>
            </tr>

            @if(isset($id_modify))
                <form action="result-full" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="wi-ma" style="margin-bottom: 25px">
                        <br><br><br><br>
                        <div class="dib" style="width: 200px; line-height: 34px; text-align: right;">
                            Нас. Пункт
                            <br>Название церкви
                            <br>Общее
                            <br>Детей
                            <br>Улица
                            <br>Номер дома
                            <br>Квартира
                            <br>Индекс
                            <br>Район
                            <br>Телефон
                            <br>эл. Почта
                            <br>веб страница
                            <br>другие
                            <br>Служение
                            <br>Дата пукоположения
                            <br>Кто рукопологал
                            <br>Телефон
                            <br>Мобильный
                            <br>эл. почта
                            <br>Улица
                            <br>Номер дома
                            <br>Квартира
                            <br>индекс
                            <br>нас.пункт
                            <br>район
                            <br>дополнительная информация
                        </div>
                        <div class="dib" style="width: 600px">
                            <input type="text" class="form-control" name="village" value="{{ $modify_position->village }}">
                            <input type="text" class="form-control" name="title" value="{{ $modify_position->title }}">
                            <input type="text" class="form-control" name="members" value="{{ $modify_position->members }}">
                            <input type="text" class="form-control" name="children" value="{{ $modify_position->children }}">
                            <input type="text" class="form-control" name="street" value="{{ $modify_position->street }}">
                            <input type="text" class="form-control" name="number" value="{{ $modify_position->number }}">
                            <input type="text" class="form-control" name="apartment" value="{{ $modify_position->apartment }}">
                            <input type="text" class="form-control" name="index" value="{{ $modify_position->index }}">
                            <input type="text" class="form-control" name="rayon" value="{{ $modify_position->rayon }}">
                            <input type="text" class="form-control" name="phone" value="{{ $modify_position->phone }}">
                            <input type="text" class="form-control" name="email" value="{{ $modify_position->email }}">
                            <input type="text" class="form-control" name="webpage" value="{{ $modify_position->webpage }}">
                            <input type="text" class="form-control" name="information" value="{{ $modify_position->information }}">
                            <input type="text" class="form-control" name="servant_name" value="{{ $modify_position->servant_name }}">
                            <input type="text" class="form-control" name="servant_register" value="{{ $modify_position->servant_register }}">
                            <input type="text" class="form-control" name="servant_register_name" value="{{ $modify_position->servant_register_name }}">
                            <input type="text" class="form-control" name="servant_phone" value="{{ $modify_position->servant_phone }}">
                            <input type="text" class="form-control" name="servant_mobile" value="{{ $modify_position->servant_mobile }}">
                            <input type="text" class="form-control" name="servant_email" value="{{ $modify_position->servant_email }}">
                            <input type="text" class="form-control" name="servant_street" value="{{ $modify_position->servant_street }}">
                            <input type="text" class="form-control" name="servant_number" value="{{ $modify_position->servant_number }}">
                            <input type="text" class="form-control" name="servant_apartment" value="{{ $modify_position->servant_apartment }}">
                            <input type="text" class="form-control" name="servant_index" value="{{ $modify_position->servant_index }}">
                            <input type="text" class="form-control" name="servant_village" value="{{ $modify_position->servant_village }}">
                            <input type="text" class="form-control" name="servant_rayon" value="{{ $modify_position->servant_rayon }}">
                            <input type="text" class="form-control" name="servant_other" value="{{ $modify_position->servant_other }}">
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
                        <form action="result-full" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_table" value="{{ $c->id }}">
                            <i class="fa fa-pencil"></i>
                            <input type="submit" name="modify" value="Изменить" class="btn btn-success btn-xs">
                        </form>
                    </td>
                    <td>{{ $c->village }}</td>
                    <td>{{ $c->title }}</td>
                    <td>{{ $c->members }}</td>
                    <td>{{ $c->children }}</td>
                    <td>{{ $c->street.' '.$c->number.' '.$c->apartment }}</td>
                    <td>{{ $c->index }}</td>
                    <td>{{ $c->rayon }}</td>
                    <td>{{ $c->phone }}</td>
                    <td>{{ $c->email }}</td>
                    <td>{{ $c->webpage }}</td>
                    <td>{{ $c->information }}</td>
                    <td>{{ $c->servant_name }}</td>
                    <td>{{ $c->servant_register }}</td>
                    <td>{{ $c->servant_register_name }}</td>
                    <td>{{ $c->servant_phone }}</td>
                    <td>{{ $c->servant_mobile }}</td>
                    <td>{{ $c->servant_email }}</td>
                    <td>{{ $c->servant_street.' '.$c->servant_number.' '.$c->servant_apartment }}</td>
                    <td>{{ $c->servant_index }}</td>
                    <td>{{ $c->servant_village }}</td>
                    <td>{{ $c->servant_rayon }}</td>
                    <td>{{ $c->servant_other }}</td>
                    <td>{{ $c->created_at }}</td>
                    <td>{{ $c->updated_at }}</td>
                    <td>
                        <form action="result-full" method="POST">
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