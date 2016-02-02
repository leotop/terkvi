@extends('head')

@section('content')

<div class="search wi-ma">
    <center>
        <a href="home" style="font-size: 24px">Адреса церквей</a>
    </center>

    <form action="search" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="text" name="title" class="form-control" placeholder="НАЗВАНИЕ ЦЕРКВИ">
        <br>
        <div class="bloc-form">
            <p>Регион</p>
            <select name="region" class="form-control" style="width: 200px">
                <option>Все</option>
                <option>Северный</option>
                <option>Бельцкий</option>
                <option>Центральный</option>
                <option>Приднестровский</option>
                <option>Южный</option>
            </select>
        </div>
        <div class="bloc-form">
            <p>Количество членов церкви</p>
            Общее
            <input type="number" name="members" class="dib form-control" style="width: 70px">
            &nbsp;&nbsp;&nbsp;Детей
            <input type="number" name="children" class="dib form-control" style="width: 70px">
        </div>
        <br><br>

        <p class="bg-primary">ПОЧТОВЫЙ АДРЕС</p>
        <div class="bloc-form">
            <p>ФИО получателя</p>
            <input type="text" name="destinatar" class="form-control" placeholder="ФИО получателя">
        </div>
        <div class="bloc-form">
            <p>Улица</p>
            <input type="text" name="street" class="form-control" placeholder="Улица">
        </div>
        <div class="bloc-form">
            <p>Номер дома</p>
            <input type="text" name="number" class="form-control" placeholder="Номер дома">
        </div>
        <br><br>
        <div class="bloc-form">
            <p>Квартира</p>
            <input type="text" name="apartment" class="form-control" placeholder="Квартира">
        </div>
        <div class="bloc-form">
            <p>Почтовый индекс</p>
            <input type="text" name="index" class="form-control" placeholder="Почтовый индекс">
        </div>
        <div class="bloc-form">
            <p>Населённый пункт (город, село)</p>
            <input type="text" name="village" class="form-control" placeholder="Населённый пункт (город, село)">
        </div>
        <br><br>
        <div class="bloc-form">
            <p>Район</p>
            <input type="text" name="rayon" class="form-control" placeholder="Район">
        </div>
        <div class="bloc-form">
            <p>Телефон</p>
            <input type="text" name="phone" class="form-control" placeholder="Телефон">
        </div>
        <div class="bloc-form">
            <p>Эл. Почта</p>
            <input type="text" name="email" class="form-control" placeholder="Эл. Почта">
        </div>
        <div class="bloc-form">
            <p>Веб страница</p>
            <input type="text" name="webpage" class="form-control" placeholder="Веб страница">
        </div>
        <br><br>
        <center>
            <input type="submit" value="Поиск" name="search_btn1" class="btn btn-success" style="width: 300px">
        </center>
        <br>
    </form>

    <form action="search" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <p class="bg-primary">СЛУЖИТЕЛЯ</p>
        <p>ФИО служителя</p>
        <input type="text" name="servant_name" class="form-control" placeholder="ФИО служителя">
        <br>
        <div class="bloc-form">
            <p>Служение</p>
            <select name="servant_post" class="form-control">
                <option>Пастор</option>
                <option>Ответственный</option>
                <option>Дьякон</option>
                <option>Евангелист</option>
            </select>
        </div>
        <div class="bloc-form">
            <p>Дата рукоположения (пример: 2015-12-30)</p>
            <input type="text" name="servant_register" class="form-control">
        </div>
        <div class="bloc-form">
            <p>ФИО рукополагавшего</p>
            <input type="text" name="servant_register_name" class="form-control" placeholder="ФИО рукополагавшего">
        </div>
        <br><br>
        <div class="bloc-form">
            <p>Телефон</p>
            <input type="text" name="servant_phone" class="form-control" placeholder="Телефон">
        </div>
        <div class="bloc-form">
            <p>Мобильный</p>
            <input type="text" name="servant_mobile" class="form-control" placeholder="Мобильный">
        </div>
        <div class="bloc-form">
            <p>Эл. Почта</p>
            <input type="text" name="servant_email" class="form-control" placeholder="Эл. Почта">
        </div>
        <br><br>

        <p class="bg-primary">ДОМАШНИЙ АДРЕС</p>
        <div class="bloc-form">
            <p>Улица</p>
            <input type="text" name="servant_street" class="form-control" placeholder="Улица">
        </div>
        <div class="bloc-form">
            <p>Номер дома</p>
            <input type="text" name="servant_number" class="form-control" placeholder="Номер дома">
        </div>
        <div class="bloc-form">
            <p>Квартира</p>
            <input type="text" name="servant_apartment" class="form-control" placeholder="Квартира">
        </div>
        <br><br>
        <div class="bloc-form">
            <p>Почтовый индекс</p>
            <input type="text" name="servant_index" class="form-control" placeholder="Почтовый индекс">
        </div>
        <div class="bloc-form">
            <p>Населённый пункт (город, село)</p>
            <input type="text" name="servant_village" class="form-control" placeholder="Населённый пункт (город, село)">
        </div>
        <div class="bloc-form">
            <p>Район</p>
            <input type="text" name="servant_rayon" class="form-control" placeholder="Район">
        </div>
        <br><br>
        <center>
            <input type="submit" value="Поиск" class="btn btn-success" style="width: 300px">
        </center>
    </form>
</div>

@stop