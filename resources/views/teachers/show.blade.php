@extends('layouts.main')

@section('header')

    <title>Id_{{$teacher->id}}</title>

@stop

@section('content')

    <div class="row">
        <h2 class="well">
            {{$teacher->degree}}
            {{$teacher->first_name}}
            {{$teacher->second_name}}
        </h2><br><br>

        <b>Subjects:</b><br><br>

        <ul class="list-group">

            @foreach($teacher->subjects as $subject)
                <li class="list-group-item">
                    {{$subject->name}}
                </li>
            @endforeach
        </ul>
    </div>

@stop