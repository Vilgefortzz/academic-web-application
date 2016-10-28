<!-- Sidebar for students-->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">

        <li class="sidebar-brand">
            <a href={{url('/students/'. Auth::guard('student')->id() .'/home')}}>
                <span class="glyphicon glyphicon-home"></span> Homepage
            </a>

        </li>

        <li>
            <a href="#">Information about you</a>
        </li>

        <li>
            <a href="#">Global marks</a>
        </li>

        <li>
            <a href="#">Local marks</a>
        </li>

        <li>
            <a href={{url('/students/'. Auth::guard('student')->id() .'/subjects')}}>Your subjects</a>
        </li>

        <li>
            <a href="#">Messages/Ads</a>
        </li>

    </ul>
</div>