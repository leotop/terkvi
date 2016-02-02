@extends('head')

@section('content')

<div class="content wi-ma">

    <div style="width: 350px; margin: 0 auto; margin-top: 200px;">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            Email
            <input type="email" name="email" class="form-control" placeholder="Email">
            Password
            <input type="password" name="password" class="form-control" placeholder="Password">
            <br>
            <input type="submit" value="Войти" class="btn btn-primary form-control">
        </form>
    </div>

</div>


@stop