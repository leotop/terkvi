<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">

    <script src="js/jquery-1.11.3.min.js"></script>
    {{--autocomplete--}}
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    {{--autocomplete end--}}
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <!-- Fonts -->
    {{--<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>--}}
    {{--<link href='https://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>--}}
    {{--<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>--}}
    {{--<link href='https://fonts.googleapis.com/css?family=Signika' rel='stylesheet' type='text/css'>--}}
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>

    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
</head>

<body>

<div class="header"></div>
@yield('content')

</body>
</html>