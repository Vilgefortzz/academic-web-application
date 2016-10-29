@extends('layouts.app')

@section('content')

    <div class="col-md-6">

        <div class="panel panel-default">

            <div class="panel-heading">
                <h1><span class="glyphicon glyphicon-blackboard"></span> {{$subject->name}}</h1>
            </div>

            <div class="panel-body">

                <h3 class="text-primary">ECTS: {{$subject->ECTS}}</h3>

                <b>Students:</b><br><br>
                <ul class="list-group">
                    @foreach($subject->students as $student)
                        {{$student->first_name}}
                        {{$student->second_name}},
                    @endforeach
                </ul>

                <b>Teachers:</b><br><br>
                <ul class="list-group">
                    @foreach($subject->teachers as $teacher)
                        {{$teacher->degree}}
                        {{$teacher->first_name}}
                        {{$teacher->second_name}},
                    @endforeach
                </ul>

            </div>

        </div>
    </div>

    <div class="col-md-4">

        <div class="panel panel-default">

            <div class="panel-heading">
                <h1>Files</h1>
            </div>

            <div class="panel-body">

                ...

            </div>

        </div>
    </div>
@stop