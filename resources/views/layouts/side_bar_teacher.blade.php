<!-- Sidebar for teachers-->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">

        <li class="sidebar-brand">
            <a href={{url('/teachers/'. Auth::guard('teacher')->id() .'/home')}}>
                <span class="glyphicon glyphicon-home"></span> Homepage
            </a>

        </li>

        <li>
            <a href="#">Information about you</a>
        </li>

        <li>
            <a href="#">Assign global marks</a>
        </li>

        <li>
            <a href="#">Assign local marks</a>
        </li>

        <li>
            <a href="#">Your subjects</a>
        </li>

        <li>
            <a href="#">Send message to students</a>
        </li>

    </ul>
</div>