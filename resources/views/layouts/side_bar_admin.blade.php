<!-- Sidebar for admins-->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">

        <li class="sidebar-brand">
            <a href={{url('/admins/'. Auth::guard('admin')->id() .'/home')}}>
                <span class="glyphicon glyphicon-home"></span> Homepage
            </a>

        </li>

        <li>
            <a href={{url('/admins/'. Auth::guard('admin')->id() . '/add/student')}}>Add new student</a>
        </li>

        <li>
            <a href={{url('/admins/'. Auth::guard('admin')->id() .'/add/teacher')}}>Add new teacher</a>
        </li>

        <li>
            <a href={{url('/admins/'. Auth::guard('admin')->id() .'/add/subject')}}>Add new subject</a>
        </li>

        <li>
            <a href={{url('/admins/'. Auth::guard('admin')->id() . '/bind/students/subject')}}>Bind students to subject</a>
        </li>

        <li>
            <a href={{url('/admins/'. Auth::guard('admin')->id() .'/bind/teachers/subject')}}>Bind teachers to subject</a>
        </li>

    </ul>
</div>