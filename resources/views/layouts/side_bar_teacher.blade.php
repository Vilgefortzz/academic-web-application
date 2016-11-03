<!-- Sidebar for teachers-->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">

        <li class="sidebar-brand">
            <a href={{url('/teachers/'. Auth::guard('teacher')->id() .'/home')}}>
                <span class="glyphicon glyphicon-home"></span> Homepage
            </a>

        </li>

        <li>
            <a href={{url('/teachers/'. Auth::guard('teacher')->id() .'/grades/panel')}}>Assign grades</a>
        </li>

        <li>
            <a href={{url('/teachers/'. Auth::guard('teacher')->id() .'/subjects')}}>Your subjects</a>
        </li>

        <li>
            <a href={{url('/teachers/'. Auth::guard('teacher')->id() .'/messages/panel')}}>Send message to students</a>
        </li>

    </ul>
</div>