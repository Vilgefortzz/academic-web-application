@extends('layouts.app')

@section('content')

    <div class="col-md-4">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h1>Assign grades</h1>
            </div>

            <div class="panel-body">

                <form name="grade_form" action="{{route('addgrade', [])}}" method="post">
                    {{ csrf_field() }}

                    <label for="student">Student:</label>
                    <select class="select" name="student" id="student" onclick="sortList('student')">

                        @foreach($teacher->subjects as $subject)

                            @foreach($subject->students as $student)

                                <option value="{{$student->id}}">{{$student->second_name}} {{$student->first_name}}</option>

                            @endforeach

                        @endforeach

                    </select>

                    <br>
                    <label for="subject">Subject:</label>
                    <select name="subject" id="subject" onclick="sortList('subject')">

                        @foreach($teacher->subjects as $subject)

                            <option value="{{$subject->id}}">{{$subject->name}}</option>

                        @endforeach


                    </select>

                    <br>
                    <label for="grade">Grade:</label>
                    <select name="grade" id="grade">

                        <option value="2">2.0</option>
                        <option value="3">3.0</option>
                        <option value="3.5">3.5</option>
                        <option value="4">4.0</option>
                        <option value="4.5">4.5</option>
                        <option value="5">5.0</option>

                    </select>

                    <br>
                    <label for="form_of_classes">Form of classes:</label>
                    <select name="form_of_classes" id="form_of_classes">

                        <option value="lab">Laboratories</option>
                        <option value="proj">Projects</option>

                    </select>

                    <br>
                    <label for="description">Description:</label>
                    <br>
                    <textarea name="description" id="description" style="width: 100%"></textarea>

                    <br>
                    <button class="btn">Assign grade</button>

                </form>

            </div>

            @if(Session::has('error'))

                <div class="alert alert-danger text-center">
                    {{Session::get('error')}}
                </div>

            @endif

            @if(Session::has('success'))

                <div class="alert alert-success text-center">
                    {{Session::get('success')}}
                </div>

            @endif

        </div>
    </div>


    <div class="col-md-7">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h1>Assigned grades by you</h1>
            </div>

            <div class="panel-body">

                    @foreach($teacher->subjects as $subject)

                        <div class="option-heading thumbnail">

                            <span class="glyphicon glyphicon-blackboard"></span> {{$subject->name}}
                            <div class="arrow-up" style="display: inline"><span class="glyphicon glyphicon-menu-up"></span></div>
                            <div class="arrow-down" style="display: inline"><span class="glyphicon glyphicon-menu-down"></span></div>

                        </div>

                        <div class="option-content">

                            <table class="table table-bordered">

                                <thead>

                                <tr>

                                    <th class="text-center"> Grade</th>
                                    <th class="text-center"> Form of classes</th>
                                    <th class="text-center"> Description</th>
                                    <th class="text-center"> Assigned to student</th>
                                    <th class="text-center"> Assigned on</th>
                                    <th class="text-center"> Action</th>

                                </tr>

                                </thead>

                                <tbody>

                                    @foreach($subject->grades->where('teacher_id', $teacher->id) as $grade)

                                        <tr>

                                            <td class="text-center" style="color: #a00524"><b>{{$grade->grade}}</b></td>
                                            <td class="text-center">{{$grade->form_of_classes}}</td>
                                            <td class="text-center">{{$grade->description}}</td>
                                            <td class="text-center">{{$grade->student->first_name}} {{$grade->student->second_name}}</td>
                                            <td class="text-center"><small style="color: darkred">{{$grade->created_at}}</small></td>
                                            <td class="text-center">

                                                <form name="delete-grade-form" id="delete-grade-form{{$grade->id}}" method="post" action="{{route('deletegrade', $grade->id)}}">
                                                    {{ csrf_field() }}
                                                    {{method_field('delete')}}

                                                    <a id="{{$grade->id}}" href="#delete-grade-form{{$grade->id}}"
                                                       onclick="event.preventDefault();
                                                         document.getElementById('delete-grade-form{{$grade->id}}').submit();">

                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </a>

                                                </form>

                                            </td>

                                        </tr>

                                    @endforeach


                                </tbody>

                            </table>

                        </div>

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