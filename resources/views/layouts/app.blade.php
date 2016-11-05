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
    <link rel="stylesheet" href="{{elixir('/css/app.css')}}" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    {{--Select styles--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- Scripts -->
    <script src="/js/app.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>

</head>
<body class="main-background">
    <div id="app">

    @if (Auth::guard('student')->check())

            <div id="wrapper" style="margin-top: 52px">

                @include('layouts.nav_student')
                @include('layouts.side_bar_student')

                <div class="container">
                    <div id="page-content-wrapper">
                        <div class="row">

                            @yield('content')

                        </div>
                    </div>
                </div>

            </div>

        @elseif(Auth::guard('teacher')->check())

            <div id="wrapper" style="margin-top: 52px">

                @include('layouts.nav_teacher')
                @include('layouts.side_bar_teacher')

                <div class="container">
                    <div id="page-content-wrapper">
                        <div class="row">

                            @yield('content')

                        </div>
                    </div>
                </div>

            </div>

        @elseif(Auth::guard('admin')->check())

            <div id="wrapper" style="margin-top: 51px">

                @include('layouts.nav_admin')
                @include('layouts.side_bar_admin')

                <div class="container">
                    <div id="page-content-wrapper">
                        <div class="row">

                            @yield('content')

                        </div>
                    </div>
                </div>

            </div>

        @else
            @include('layouts.nav_guest')

            <div class="container">
                <div class="row">

                    @yield('content')

                </div>
            </div>

        @endif

    </div>

    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

</body>
</html>
