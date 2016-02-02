@extends('head')

@section('content')

<div class="home wi-ma">

<script>
    $(document).ready(function(){
        $('#2,#3,#4,#5,#6,#7,#8,#9,#10,#11,#12,#13,#14,#15').hide();

        var village = [
            "Отачь",
            "Бельцы",
            "Бендеры",
            "Бессарабка",
            "Бируинца",
            "Бричаны",
            "Быковец",
            "Вадул-луй-Водэ",
            "Ватра",
            "Вулканешты",
            "Гиндешты",
            "Глодяны",
            "Днестровск",
            "Григориополь",
            "Дондюшаны",
            "Дрокия",
            "Дубоссары",
            "Дурлешты",
            "Единцы",
            "Кагул",
            "Каинары",
            "Калараш",
            "Каменка",
            "Кантемир",
            "Каушаны",
            "Кишинёв",
            "Кодру",
            "Комрат",
            "Корнешты",
            "Костешты",
            "Красное",
            "Криково",
            "Криуляны",
            "Купчинь",
            "Леово",
            "Липканы",
            "Маркулешты",
            "Маяк",
            "Ниспорены",
            "Новотираспольский",
            "Новые Анены",
            "Окница",
            "Оргеев",
            "Резина",
            "Рыбница",
            "Рышканы",
            "Слободзея",
            "Сороки",
            "Страшены",
            "Сынжера",
            "Сынжерея",
            "Тараклия",
            "Теленешты",
            "Тирасполь",
            "Унгены",
            "Фалешты",
            "Флорешты",
            "Фрунзе",
            "Хынчешты",
            "Чадыр-Лунга",
            "Чимишлия",
            "Шолданешты",
            "Штефан-Водэ",
            "Яловены",
            "Яргара"
        ];

        <?php
        for ($i=1; $i<=15; $i++) {
            $n = $i+1;
            echo "
                $('a[href=\"add_servant_$i\"]').on('click', function(e){
                    $('#".$n."').show();
                    e.preventDefault();
                });
            ";
            echo "
                $('input[name=\"duplicate_contact$i\"]').on('click', function(){
                var street, number, apartment, index, village, rayon;
                street = $('input[name=\"street\"]').val();
                number = $('input[name=\"number\"]').val();
                apartment = $('input[name=\"apartment\"]').val();
                index = $('input[name=\"index\"]').val();
                village = $('input[name=\"village\"]').val();
                rayon = $('input[name=\"rayon\"]').val();
                //Add values
                $('input[name=\"servant_street$i\"]').val(street);
                $('input[name=\"servant_number$i\"]').val(number);
                $('input[name=\"servant_apartment$i\"]').val(apartment);
                $('input[name=\"servant_index$i\"]').val(index);
                $('input[name=\"servant_village$i\"]').val(village);
                $('input[name=\"servant_rayon$i\"]').val(rayon);
        });
            ";
            echo "
                $('input[name=\"servant_village$i\"]').autocomplete({
                    source: village
                });
            ";
        }
        ?>

        $('input[name="village"]').autocomplete({
            source: village
        });
    });
</script>

    <center>
        <h4>АДРЕСА ЦЕРКВЕЙ</h4>
        <i>База данных адресов церквей Союза Пятидесятников Молдовы</i>
        <br>
    </center>

    {{--SEARCH-MENU--}}
    <p class="bg-success" style="padding: 10px;">
        <i class="fa fa-search">&nbsp;</i>Поиск <i>(Введите название церкви или имя служителя)</i>
    </p>
    <form action="search" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="bloc-form">
            <p>НАЗВАНИЕ ЦЕРКВИ</p>
            <input type="text" name="title" class="form-control" placeholder="НАЗВАНИЕ ЦЕРКВИ">
        </div>
        <div class="bloc-form">
            <p>ФИО служителя</p>
            <input type="text" name="servant_name" class="form-control" placeholder="ФИО служителя">
        </div>
        <input type="submit" value="Поиск" class="btn btn-success">
    </form>

    <br>
    <p class="bg-success" style="padding: 10px;">
        <i class="fa fa-search-plus">&nbsp;</i>Фильтры данных
    </p>
    <br>

    <form action="search" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token()  }}">
        <input type="hidden" name="title">
        <input type="submit" value="Показать все церкви" class="btn btn-success">
    </form>

    <br>

    <form action="search" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token()  }}">
        <div class="bloc-form">
            <p>Регион</p>
            <select name="region_search" size="4" class="form-control" value="">
                <option selected="selected">Все</option>
                <option>Северный</option>
                <option>Бельцкий</option>
                <option>Центральный</option>
                <option>Приднестровский</option>
                <option>Южный</option>
            </select>
        </div>
        <div class="bloc-form">
            <p>Населенный пункт</p>
            <select name="village_search" size="4" class="form-control" value="">
                <option selected="selected">Все</option>
                @foreach($village as $v)
                    <option>{{ $v->village }}</option>
                @endforeach
            </select>
        </div>
        <div class="bloc-form">
            <input type="submit" value="Поиск" class="btn btn-success">
        </div>
    </form>
    <br><br>

    {{--CREATE RECORD--}}
    <form action="create" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{--<div class="form-group has-error">--}}
            {{--<label class="control-label">Input with error</label>--}}
            {{--<input type="text" class="form-control">--}}
        {{--</div>--}}
        <p class="bg-primary">
            <i class="fa fa-institution"></i> НАЗВАНИЕ ЦЕРКВИ (Ввод Данных)
        </p>

        @if ($errors->has('title'))
            <div class="has-error">
            <p class="bg-danger">{{ $errors->first('title') }}</p>
        @endif
        <input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="НАЗВАНИЕ ЦЕРКВИ">
        @if ($errors->has('title')) </div> @endif

        <br>
        <div class="bloc-form">
            <p>Регион</p>
            <select name="region" value="{{old('region')}}" class="form-control" style="width: 200px">
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
            @if ($errors->has('members'))
                <div class="has-error">
            @endif
                <input type="number" name="members" value="1" class="dib form-control" style="width: 70px">
            @if ($errors->has('members')) </div> @endif
            &nbsp;&nbsp;&nbsp;Детей
            @if ($errors->has('children'))
                <div class="has-error">
            @endif
                <input type="number" name="children" value="1" class="dib form-control" style="width: 70px">
            @if ($errors->has('children')) </div> @endif
        </div>
        <br><br>

        <p class="bg-primary">
            <i class="fa fa-envelope">&nbsp;</i>ПОЧТОВЫЙ АДРЕС
        </p>
        <div class="bloc-form">
            <p>ФИО получателя</p>
            <input type="text" name="destinatar" value="{{old('destinatar')}}" class="form-control" placeholder="ФИО получателя">
        </div>
        <div class="bloc-form">
            <p>Улица</p>
            <input type="text" name="street" value="{{old('street')}}" class="form-control" placeholder="Улица">
        </div>
        <div class="bloc-form">
            <p>Номер дома</p>
            <input type="text" name="number" value="{{old('number')}}" class="form-control" placeholder="Номер дома">
        </div>
        <br><br>
        <div class="bloc-form">
            <p>Квартира</p>
            <input type="text" name="apartment" value="{{old('apartment')}}" class="form-control" placeholder="Квартира">
        </div>
        <div class="bloc-form">
            <p>Почтовый индекс MD-</p>
            <input type="text" name="index" value="{{old('index')}}" class="form-control" placeholder="4 цифры">
        </div>
        <div class="bloc-form">
            <p>Населённый пункт (город, село)</p>
            <input type="text" name="village" value="{{old('village')}}" class="form-control" placeholder="Населённый пункт (город, село)">
        </div>
        <br><br>
        <div class="bloc-form">
            <p>Район</p>
            <input type="text" name="rayon" value="{{old('rayon')}}" class="form-control" placeholder="Район">
        </div>
        <br><br>

        <p class="bg-primary">
            <i class="fa fa-phone-square">&nbsp;</i>КОНТАКТЫ (Здесь ведите контактные данные церкви, а не служителя. )
        </p>
        <div class="bloc-form">
            <p>Телефон</p>
            @if ($errors->has('phone'))
                <div class="has-error">
            @endif
                <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Телефон">
            @if ($errors->has('phone')) </div> @endif
        </div>
        <div class="bloc-form">
            <p>Эл. Почта</p>
            <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Эл. Почта">
        </div>
        <div class="bloc-form">
            <p>Веб страница</p>
            <input type="text" name="webpage" value="{{old('webpage')}}" class="form-control" placeholder="Веб страница">
        </div>
        <br><br>
        <p>Другие</p>
        <textarea name="other" value="{{old('other')}}" class="form-control" placeholder="Другие"></textarea>
        <br><br>

        @for ($i=1; $i<=15; $i++)
            <div id="{{ $i }}">
                <p class="bg-primary">
                    <i class="fa fa-user">&nbsp;</i>СЛУЖИТЕЛЯ
                </p>
                <p class="dib">Главный патор / ответственный</p>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" class="form-control dib" name="servant_principal{{$i}}" style="transform: scale(1.5); width: 13px; height: 13px">
                <p>ФИО служителя</p>
                <input type="text" name="servant_name{{$i}}" value="{{old('servant_name'.$i)}}" class="form-control" placeholder="ФИО служителя">
                <br>
                <div class="bloc-form">
                    <p>Служение</p>
                    <select name="servant_post{{$i}}" value="{{old('servant_post'.$i)}}" class="form-control">
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
                    <input type="text" name="servant_register_name{{$i}}" value="{{old('servant_register_name'.$i)}}" class="form-control" placeholder="ФИО рукополагавшего">
                </div>
                <br><br>
                <div class="bloc-form">
                    <p>Телефон</p>
                    <input type="text" name="servant_phone{{$i}}" value="{{old('servant_phone'.$i)}}" class="form-control" placeholder="Телефон">
                </div>
                <div class="bloc-form">
                    <p>Мобильный</p>
                    <input type="text" name="servant_mobile{{$i}}" value="{{old('servant_mobile'.$i)}}" class="form-control" placeholder="Мобильный">
                </div>
                <div class="bloc-form">
                    <p>Эл. Почта</p>
                    <input type="text" name="servant_email{{$i}}" value="{{old('servant_email'.$i)}}" class="form-control" placeholder="Эл. Почта">
                </div>
                <br><br>

                <p class="bg-primary">ДОМАШНИЙ АДРЕС</p>
                <u>Тот же, что и церковный</u>
                <input type="checkbox" name="duplicate_contact{{$i}}" value="{{old('duplicate_contact'.$i)}}" style="transform: scale(1.5); width: 32px;">
                <br>
                <div class="bloc-form">
                    <p>Улица</p>
                    <input type="text" name="servant_street{{$i}}" value="{{old('servant_street'.$i)}}" class="form-control" placeholder="Улица">
                </div>
                <div class="bloc-form">
                    <p>Номер дома</p>
                    <input type="text" name="servant_number{{$i}}" value="{{old('servant_number'.$i)}}" class="form-control" placeholder="Номер дома">
                </div>
                <div class="bloc-form">
                    <p>Квартира</p>
                    <input type="text" name="servant_apartment{{$i}}" value="{{old('servant_apartment'.$i)}}" class="form-control" placeholder="Квартира">
                </div>
                <br><br>
                <div class="bloc-form">
                    <p>Почтовый индекс MD-</p>
                    <input type="text" name="servant_index{{$i}}" value="{{old('servant_index'.$i)}}" class="form-control" placeholder="4 цифры">
                </div>
                <div class="bloc-form">
                    <p>Населённый пункт (город, село)</p>
                    <input type="text" name="servant_village{{$i}}" value="{{old('servant_village'.$i)}}" class="form-control" placeholder="Населённый пункт (город, село)">
                </div>
                <div class="bloc-form">
                    <p>Район</p>
                    <input type="text" name="servant_rayon{{$i}}" value="{{old('servant_rayon'.$i)}}" class="form-control" placeholder="Район">
                </div>
                <br><br>
                <a href="add_servant_{{ $i }}" class="btn btn-success">
                    <i class="fa fa-user-plus">&nbsp;</i>
                    Добавить ещё служителя
                </a>
                <br><br>
                <p>ДОПОЛНИТЕЛЬНАЯ ИНФОРМАЦИЯ</p>
                <textarea name="servant_other{{$i}}" value="{{old('servant_other'.$i)}}" class="form-control" placeholder="ДОПОЛНИТЕЛЬНАЯ ИНФОРМАЦИЯ"></textarea>
                <br>
            </div>
        @endfor


        <center>
            <input type="submit" value="Отправить данные" class="btn btn-primary">
        </center>
    </form>

    <div style="height: 50px"></div>
</div>



@stop