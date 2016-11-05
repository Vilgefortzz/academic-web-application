@extends('layouts.app')

@section('content')

    <div class="col-md-4">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h1>Create new subject</h1>
            </div>

            <div class="panel-body">

                <form name="subject_form" action="{{url('/add/subject')}}" method="post">
                    {{ csrf_field() }}

                    <label for="name">Name:</label><br>
                    <input id="name" name="name" type="text" required><br>

                    <label for="ects">ECTS:</label><br>
                    <input id="ects" name="ects" type="number" required><br>

                    <br>
                    <button class="btn">Create subject</button>

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
                <h1>All subjects</h1>
            </div>

            <div class="panel-body">

                @foreach($subjects as $subject)

                    <div class="option-heading">

                        <span class="glyphicon glyphicon-book"></span> {{$subject->name}}
                        <div class="arrow-up" style="display: inline"><span class="glyphicon glyphicon-menu-up"></span></div>
                        <div class="arrow-down" style="display: inline"><span class="glyphicon glyphicon-menu-down"></span></div>

                    </div>

                    <div class="option-content">

                        <b>ECTS:</b> {{$subject->ECTS}}<br>
                        <b style="color: #29b270">Created at:</b> {{$subject->created_at}}

                        <form name="delete-subject-form" id="delete-subject-form{{$subject->id}}" method="post" action="{{route('deletesubject', $subject->id)}}">
                            {{ csrf_field() }}
                            {{method_field('delete')}}

                            <a id="{{$subject->id}}" href="#delete-subject-form{{$subject->id}}"
                               onclick="event.preventDefault();
                                       document.getElementById('delete-subject-form{{$subject->id}}').submit();">

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