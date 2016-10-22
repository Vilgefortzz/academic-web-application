<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Virtual University') }}</title>

    <!-- Styles -->
    <link href="{{elixir('css/app.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="main-background">
    <div id="app">

        @include('layouts.nav')

        <div class="container">

            @yield('content')

        </div>

    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
