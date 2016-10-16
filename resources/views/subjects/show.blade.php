@extends('layouts.main')

@section('header')

    <title>Id_{{$subject->id}}</title>

@stop

@section('content')

    <div class="row">

        <h2 class="well">{{$subject->name}}</h2>

        <h3 class="text-primary">ECTS:</h3>
        <h2>{{$subject->ECTS}}</h2><br>

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

        <br><br>

        <form method="post" action="/subjects/{{$subject->id}}/students">

            {{--Needed!!!--}}
            {{ csrf_field() }}

            <textarea class="form-control" name="id"></textarea>
            <br>
            <button type="submit" class="btn-sm">Click it</button>

        </form>
    </div>

@stop