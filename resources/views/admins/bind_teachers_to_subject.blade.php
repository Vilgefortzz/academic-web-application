@extends('layouts.app')

@section('content')

    <div class="col-md-4">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h1>Bind teachers to subject</h1>
            </div>

            <div class="panel-body">

                <form name="bind_form" action="{{url('/bind/teachers/subject')}}" method="post">
                    {{ csrf_field() }}

                    <label for="teacher">Teachers:</label><br>
                    <select class="selectpicker show-tick" name="teacher[]" id="teacher" onclick="sortList('teacher')" multiple>

                        @foreach($teachers as $teacher)

                            <option value="{{$teacher->id}}">{{$teacher->degree}} {{$teacher->first_name}} {{$teacher->second_name}}</option>

                        @endforeach

                    </select>

                    <br>
                    <label for="subject">Subject:</label><br>
                    <select class="selectpicker show-tick" name="subject" id="subject" onclick="sortList('subject')">

                        @foreach($subjects as $subject)

                            <option value="{{$subject->id}}">{{$subject->name}}</option>

                        @endforeach

                    </select>

                    <br><br>
                    <button class="btn">Bind it</button>

                </form>

            </div>

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
                <h1>Bindings between teachers and subjects</h1>
            </div>

            <div class="panel-body">

                @foreach($teachers as $teacher)

                    @foreach($teacher->subjects as $subject)

                        <div class="option-heading thumbnail">

                            <span class="glyphicon glyphicon-education"></span> {{$teacher->degree}} {{$teacher->first_name}} {{$teacher->second_name}}
                            -> <span class="glyphicon glyphicon-blackboard"></span> {{$subject->name}}
                            <div class="arrow-up" style="display: inline"><span class="glyphicon glyphicon-menu-up"></span></div>
                            <div class="arrow-down" style="display: inline"><span class="glyphicon glyphicon-menu-down"></span></div>
                        </div>

                        <div class="option-content">

                            <span class="glyphicon glyphicon-user"></span>
                            {{$teacher->degree}} {{$teacher->first_name}} {{$teacher->second_name}}<br>
                            <span class="glyphicon glyphicon-blackboard"></span>
                            {{$subject->name}}

                            <form name="delete-bind-form" id="delete-bind-form{{$teacher->id}}-{{$subject->id}}" method="post" action="{{route('deletebindteacher', [$teacher->id, $subject->id])}}">
                                {{ csrf_field() }}
                                {{method_field('delete')}}

                                <a id="{{$teacher->id}}_{{$subject->id}}" href="#delete-bind-form{{$teacher->id}}-{{$subject->id}}"
                                   onclick="event.preventDefault();
                                           document.getElementById('delete-bind-form{{$teacher->id}}-{{$subject->id}}').submit();">

                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>

                            </form>

                        </div>

                    @endforeach

                @endforeach

            </div>

        </div>
    </div>

    {{--Sort options by some condition--}}
    <script src="/js/sort.js"></script>

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

    {{--Remove duplicates from options--}}
    <script>

        var found = [];
        $(".select option").each(function() {
            if($.inArray(this.value, found) != -1) $(this).remove();
            found.push(this.value);
        });

    </script>

@stop