<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            @if(Auth::guard('student')->guest() && Auth::guard('teacher')->guest())

                <b><a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Virtual University') }}
                    </a></b>
            @else

                @if(Auth::guard('student')->check())
                    <a href={{url('/students/'. Auth::guard('student')->id() .'/home')}}> <img src="/images/home.png" height="60" width="60"></a>
                @elseif(Auth::guard('teacher')->check())
                    <a href={{url('/teachers/'. Auth::guard('teacher')->id() .'/home')}}> <img src="/images/home.png" height="60" width="60"></a>
                @endif

            @endif


        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav navbar-left">
                <li><a href="http://www.agh.edu.pl/">
                        Agh - official website
                    </a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guard('student')->guest() && Auth::guard('teacher')->guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                            @if(Auth::guard('student')->check())
                                <img src="/images/student.png" height="40" width="40">
                                {{ Auth::guard('student')->user()->first_name }}
                                {{ Auth::guard('student')->user()->second_name}}
                                <span class="caret"></span>
                            @elseif(Auth::guard('teacher')->check())
                                <img src="/images/teacher.jpg" height="40" width="40">
                                {{ Auth::guard('teacher')->user()->first_name }}
                                {{ Auth::guard('teacher')->user()->second_name}}
                                <span class="caret"></span>
                            @endif

                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/handleLogout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
