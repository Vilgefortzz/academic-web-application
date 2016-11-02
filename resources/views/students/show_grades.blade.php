@extends('layouts.app')

@section('content')

    <div class="col-md-8">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h1>Your grades</h1>
            </div>

            <div class="panel-body">

                <div class="thumbnail">

                    @foreach($student->subjects as $subject)

                        <div class="option-heading">

                            <span class="glyphicon glyphicon-blackboard"></span> {{$subject->name}}
                            <div class="arrow-up" style="display: inline"> <span class="glyphicon glyphicon-menu-up"></span></div>
                            <div class="arrow-down" style="display: inline"> <span class="glyphicon glyphicon-menu-down"></span></div>

                        </div>

                        @foreach($subject->grades->where('student_id', $student->id) as $grade)

                            <div class="option-content">

                                <table class="table table-bordered">

                                    <thead>

                                    <tr>

                                        <th class="text-center"> Grade</th>
                                        <th class="text-center"> Form of classes</th>
                                        <th class="text-center"> Description</th>
                                        <th class="text-center"> Assigned by teacher</th>
                                        <th class="text-center"> Assigned on</th>

                                    </tr>

                                    </thead>

                                    <tbody>

                                    <tr>

                                        <td class="text-center" style="color: #a00524"><b>{{$grade->grade}}</b></td>
                                        <td class="text-center">{{$grade->form_of_classes}}</td>
                                        <td class="text-center">{{$grade->description}}</td>
                                        <td class="text-center">{{$grade->teacher->degree}} {{$grade->teacher->first_name}} {{$grade->teacher->second_name}}</td>
                                        <td class="text-center"><small style="color: darkred">{{$grade->created_at}}</small></td>

                                    </tr>

                                    </tbody>

                                </table>

                            </div>

                        @endforeach

                    @endforeach

                </div>

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