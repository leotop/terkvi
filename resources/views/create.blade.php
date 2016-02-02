@extends('head')

@section('content')

<script>
$(document).ready(function(){
    $('input[name="duplicate_contact"]').on('click', function(){
        var street, number, apartment, index, village, rayon;
        street = $('input[name="street"]').val();
        number = $('input[name="number"]').val();
        apartment = $('input[name="apartment"]').val();
        index = $('input[name="index"]').val();
        village = $('input[name="village"]').val();
        rayon = $('input[name="rayon"]').val();
        //Add values
        $('input[name="servant_street"]').val(street);
        $('input[name="servant_number"]').val(number);
        $('input[name="servant_apartment"]').val(apartment);
        $('input[name="servant_index"]').val(index);
        $('input[name="servant_village"]').val(village);
        $('input[name="servant_rayon"]').val(rayon);
    });
    $('#2,#3,#4,#5,#6,#7,#8,#9,#10,#11,#12,#13,#14,#15').hide();
    var i;
    <?php
    for ($i=1; $i<=15; $i++) {
        $n = $i+1;
        echo "
        $('a[href=\"add_servant_$i\"]').on('click', function(e){
            $('#".$n."').show();
            e.preventDefault();
        });
        ";
    }
    ?>
});
</script>

<div class="dashboard wi-ma">
    <center>
        <a href="home" style="font-size: 24px">Адреса церквей</a>
    </center>

    <form action="create" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <p class="bg-primary">НАЗВАНИЕ ЦЕРКВИ</p>
        <input type="text" name="title" class="form-control" placeholder="НАЗВАНИЕ ЦЕРКВИ">
        <br>
        <div class="bloc-form">
            <p>Регион</p>
            <select name="region" class="form-control" style="width: 200px">
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
            <input type="number" name="members" value="1" class="dib form-control" style="width: 70px">
            &nbsp;&nbsp;&nbsp;Детей
            <input type="number" name="children" value="1" class="dib form-control" style="width: 70px">
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
            <input type="text" name="index" value="MD-" class="form-control" placeholder="Почтовый индекс">
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
        <br><br>

        <p class="bg-primary">КОНТАКТЫ (Здесь ведите контактные данные церкви, а не служителя. )</p>
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
        <p>Другие</p>
        <textarea name="other" class="form-control" placeholder="Другие"></textarea>
        <br><br>

        @for ($i=1; $i<=15; $i++)
            <div id="{{ $i }}">
                <p class="bg-primary">СЛУЖИТЕЛЯ</p>
                <p class="dib">Главный патор / ответственный</p>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" class="form-control dib" name="servant_principal{{$i}}" style="transform: scale(1.5); width: 13px; height: 13px">
                <p>ФИО служителя</p>
                <input type="text" name="servant_name{{$i}}" class="form-control" placeholder="ФИО служителя">
                <br>
                <div class="bloc-form">
                    <p>Служение</p>
                    <select name="servant_post{{$i}}" class="form-control">
                        <option>Пастор</option>
                        <option>Ответственный</option>
                        <option>Дьякон</option>
                        <option>Евангелист</option>
                    </select>
                </div>
                <div class="bloc-form">
                    <p>Дата рукоположения</p>
                    <input type="date" name="servant_register{{$i}}" value="2015-12-30" class="form-control">
                </div>
                <div class="bloc-form">
                    <p>ФИО рукополагавшего</p>
                    <input type="text" name="servant_register_name{{$i}}" class="form-control" placeholder="ФИО рукополагавшего">
                </div>
                <br><br>
                <div class="bloc-form">
                    <p>Телефон</p>
                    <input type="text" name="servant_phone{{$i}}" class="form-control" placeholder="Телефон">
                </div>
                <div class="bloc-form">
                    <p>Мобильный</p>
                    <input type="text" name="servant_mobile{{$i}}" class="form-control" placeholder="Мобильный">
                </div>
                <div class="bloc-form">
                    <p>Эл. Почта</p>
                    <input type="text" name="servant_email{{$i}}" class="form-control" placeholder="Эл. Почта">
                </div>
                <br><br>

                <p class="bg-primary">ДОМАШНИЙ АДРЕС</p>
                <u>Тот же, что и церковный</u>
                <input type="checkbox" name="duplicate_contact" style="transform: scale(1.5); width: 32px;">
                <br>
                <div class="bloc-form">
                    <p>Улица</p>
                    <input type="text" name="servant_street{{$i}}" class="form-control" placeholder="Улица">
                </div>
                <div class="bloc-form">
                    <p>Номер дома</p>
                    <input type="text" name="servant_number{{$i}}" class="form-control" placeholder="Номер дома">
                </div>
                <div class="bloc-form">
                    <p>Квартира</p>
                    <input type="text" name="servant_apartment{{$i}}" class="form-control" placeholder="Квартира">
                </div>
                <br><br>
                <div class="bloc-form">
                    <p>Почтовый индекс</p>
                    <input type="text" name="servant_index{{$i}}" class="form-control" placeholder="Почтовый индекс">
                </div>
                <div class="bloc-form">
                    <p>Населённый пункт (город, село)</p>
                    <input type="text" name="servant_village{{$i}}" class="form-control" placeholder="Населённый пункт (город, село)">
                </div>
                <div class="bloc-form">
                    <p>Район</p>
                    <input type="text" name="servant_rayon{{$i}}" class="form-control" placeholder="Район">
                </div>
                <br><br>
                <a href="add_servant_{{ $i }}" class="btn btn-success">Добавить ещё служителя</a>
                <br><br>
                <p>ДОПОЛНИТЕЛЬНАЯ ИНФОРМАЦИЯ</p>
                <textarea name="servant_other{{$i}}" class="form-control" placeholder="ДОПОЛНИТЕЛЬНАЯ ИНФОРМАЦИЯ"></textarea>
                <br>
            </div>
        @endfor


        <center>
            <input type="submit" value="Отправить данные" class="btn btn-primary">
        </center>
    </form>
</div>
{{--<a href="logout" class="btn btn-primary">Выход</a>--}}
@stop














