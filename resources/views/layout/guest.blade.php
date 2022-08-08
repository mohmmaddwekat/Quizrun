<!DOCTYPE html>
<html lang="{{ App::currentLocale() }}" dir="{{ App::isLocale('ar') ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIZRUN-{{ $page_title }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    @if (App::isLocale('ar'))
        <link rel="stylesheet" href="{{ url('/assets/css/adminlte.rtl.min.css') }}">
    @else
        <link rel="stylesheet" href="{{ url('/assets/css/adminlte.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ url('/assets/css/app.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @include('layout.navbar-guest')
    @include($view_file, $controller_data)

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ url('/assets/js/adminlte.min.js') }}"></script>
    <script src="{{ url('/assets/js/app.js') }}"></script>
    <script src="{{ url('/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
</body>

</html>
