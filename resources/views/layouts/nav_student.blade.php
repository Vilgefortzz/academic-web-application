<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav navbar-left">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">

                <li id="switch">

                    <a href="#menu-toggle" id="menu-toggle"><span class="glyphicon glyphicon-eye-open"></span> Show/Hide Sidebar</a>

                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                        <img src="/images/student.png" height="20" width="20">
                        {{ Auth::guard('student')->user()->first_name }}
                        {{ Auth::guard('student')->user()->second_name}}
                        <span class="caret"></span>

                    </a>

                    <ul class="dropdown-menu" role="menu">

                        <li>
                            <a href={{url('/students/'. Auth::guard('student')->id() .'/edit')}}>
                                <span class="glyphicon glyphicon-edit"></span> Change your password
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-out"></span> Logout
                            </a>

                            <form id="logout-form" action="{{ url('/handleLogout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
