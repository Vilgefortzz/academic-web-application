@extends('layouts.app')

@section('content')

    <div class="col-md-4">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h1>Create new student</h1>
            </div>

            <div class="panel-body">

                <form name="student_form" action="{{url('/add/student')}}" method="post">
                    {{ csrf_field() }}

                    <label for="album_number">Album number:</label><br>
                    <input id="album_number" name="album_number" type="number" required><br>

                    <label for="first_name">First name:</label><br>
                    <input id="first_name" name="first_name" type="text" required><br>

                    <label for="second_name">Second name:</label><br>
                    <input id="second_name" name="second_name" type="text" required><br>

                    <label for="email">Email:</label><br>
                    <input id="email" name="email" type="email" required><br>

                    <label for="pr_group">Project group:</label><br>
                    <input id="pr_group" name="pr_group" type="number" required><br>

                    <label for="lab_group">Laboratory group:</label><br>
                    <input id="lab_group" name="lab_group" type="number" required><br>

                    <br>
                    <button class="btn">Create student</button>

                </form>

            </div>

            {{--Handle data validation--}}
            @if (count($errors) > 0)
                <div class="alert alert-danger text-center">
                    @foreach ($errors->all() as $error)
                        <b>{{ $error }}</b>
                    @endforeach
                </div>
            @endif

            @if(Session::has('error'))

                <div class="alert alert-danger text-center">
                    <b>{{Session::get('error')}}</b>
                </div>

            @endif

            @if(Session::has('success'))

                <div class="alert alert-success text-center">
                    <b>{{Session::get('success')}}</b>
                </div>

            @endif

        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h1>All students</h1>
            </div>

            <div class="panel-body">

                @foreach($students as $student)

                    <div class="option-heading">

                        <span class="glyphicon glyphicon-education"></span> {{$student->first_name}} {{$student->second_name}} {{$student->album_number}}
                        <div class="arrow-up" style="display: inline"><span class="glyphicon glyphicon-menu-up"></span></div>
                        <div class="arrow-down" style="display: inline"><span class="glyphicon glyphicon-menu-down"></span></div>

                    </div>

                    <div class="option-content">

                        <b>Email:</b> {{$student->email}}<br>
                        <b>First generated password:</b> {{$student->generatedPassword->generated_password}}<br>
                        <b>Project group:</b> {{$student->pr_group}}<br>
                        <b>Laboratory group:</b> {{$student->lab_group}}<br>
                        <b style="color: #29b270">Created at:</b> {{$student->created_at}}

                        <form name="delete-student-form" id="delete-student-form{{$student->id}}" method="post" action="{{route('deletestudent', $student->id)}}">
                            {{ csrf_field() }}
                            {{method_field('delete')}}

                            <a id="{{$student->id}}" href="#delete-student-form{{$student->id}}"
                               onclick="event.preventDefault();
                                       document.getElementById('delete-student-form{{$student->id}}').submit();">

                                <span class="glyphicon glyphicon-trash"></span>
                            </a>

                        </form>

                    </div>

                @endforeach

            </div>

        </div>
    </div>

    {{--Hide/show list--}}
    <script>

        $(document).ready(function() {
            $(".option-content").hide();
            $(".arrow-up").hide();
            $(".option-heading").click(function(){
                $(this).next(".option-content").slideToggle(500);
                $(this).find(".arrow-up, .arrow-down").toggle();
            });
        });

    </script>

@stop