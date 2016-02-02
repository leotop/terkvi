@extends('head')

@section('content')

<div class="record table-responsive">
    <table class="table table-bordered table-condensed table-hover table-striped">
        <tr>
            <td>Id</td>
            <td>Церковь</td>
            <td>Регион</td>
            <td>Общее</td>
            <td>Детей</td>
            <td>Получатель</td>
            <td>Улица</td>
            <td>Дом</td>
            <td>Кв.</td>
            <td>Индекс</td>
            <td>Пункт</td>
            <td>Район</td>
            <td>Тел.</td>
            <td>Почта</td>
            <td>Страница</td>
            <td>Другие</td>
            <td>Создан</td>
            <td>Обновлен</td>
        </tr>
        @foreach($churches as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->title }}</td>
                <td>{{ $c->region }}</td>
                <td>{{ $c->members }}</td>
                <td>{{ $c->children }}</td>
                <td>{{ $c->destinatar }}</td>
                <td>{{ $c->street }}</td>
                <td>{{ $c->number }}</td>
                <td>{{ $c->apartment }}</td>
                <td>{{ $c->index }}</td>
                <td>{{ $c->village }}</td>
                <td>{{ $c->rayon }}</td>
                <td>{{ $c->phone }}</td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->webpage }}</td>
                <td>{{ $c->other }}</td>
                <td>{{ $c->created_at }}</td>
                <td>{{ $c->updated_at }}}</td>
            </tr>
        @endforeach
    </table>
</div>
<a href="export" class="btn btn-primary">Export database !</a>

@stop