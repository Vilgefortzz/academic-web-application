@extends('layouts.app')

@section('content')

    <div class="col-md-8">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h1>Your subjects</h1>
            </div>

            <div class="panel-body">

                <table style="width: 70%" class="table table-bordered">

                    <thead>
                    <tr>

                            <th class="text-center"><span class="glyphicon glyphicon-blackboard"></span> Subject</th>
                            <th class="text-center"><span class="glyphicon glyphicon-education"></span> Teachers</th>
                            <th class="text-center"><span class="glyphicon glyphicon-piggy-bank"></span> ECTS</th>

                    </tr>
                    </thead>

                    <tbody>

                    @foreach($student->subjects as $subject)

                        <tr>
                            <td class="text-center"><a style="text-decoration: none; color: #2ab27b" href={{url('/subjects/'. $subject->id)}}>{{$subject->name}}</a></td>

                            <td class="text-center">
                                @foreach($subject->teachers as $teacher)

                                    {{$teacher->degree}}
                                    {{$teacher->first_name}}
                                    {{$teacher->second_name}},

                                @endforeach
                            </td>

                            <td class="text-center">{{$subject->ECTS}}</td>
                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>

@stop