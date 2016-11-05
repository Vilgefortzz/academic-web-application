@extends('layouts.app')

@section('content')

    <div class="col-md-4">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h1>Create new teacher</h1>
            </div>

            <div class="panel-body">

                <form name="teacher_form" action="{{url('/add/teacher')}}" method="post">
                    {{ csrf_field() }}

                    <label for="first_name">First name:</label><br>
                    <input id="first_name" name="first_name" type="text" required><br>

                    <label for="second_name">Second name:</label><br>
                    <input id="second_name" name="second_name" type="text" required><br>

                    <label for="degree">Degree:</label><br>
                    <input id="degree" name="degree" type="text" required><br>

                    <label for="email">Email:</label><br>
                    <input id="email" name="email" type="email" required><br>

                    <br>
                    <button class="btn">Create teacher</button>

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

    <div class="col-md-7">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h1>All teachers</h1>
            </div>

            <div class="panel-body">

                @foreach($teachers as $teacher)

                    <div class="option-heading">

                        <span class="glyphicon glyphicon-education"></span> {{$teacher->degree}} {{$teacher->first_name}} {{$teacher->second_name}}
                        <div class="arrow-up" style="display: inline"><span class="glyphicon glyphicon-menu-up"></span></div>
                        <div class="arrow-down" style="display: inline"><span class="glyphicon glyphicon-menu-down"></span></div>

                    </div>

                    <div class="option-content">

                        <b>Email:</b> {{$teacher->email}}<br>
                        <b>First generated password:</b> {{$teacher->generatedPassword->generated_password}}<br>
                        <b style="color: #29b270">Created at:</b> {{$teacher->created_at}}

                        <form name="delete-teacher-form" id="delete-teacher-form{{$teacher->id}}" method="post" action="{{route('deleteteacher', $teacher->id)}}">
                            {{ csrf_field() }}
                            {{method_field('delete')}}

                            <a id="{{$teacher->id}}" href="#delete-teacher-form{{$teacher->id}}"
                               onclick="event.preventDefault();
                                       document.getElementById('delete-teacher-form{{$teacher->id}}').submit();">

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