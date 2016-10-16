@extends('layouts.main')

@section('header')

    <title>All teachers</title>

@stop

@section('content')

    @foreach($teachers as $teacher)
        <li class="list-group-item">
            {{$teacher->degree}}
            {{$teacher->first_name}}
            {{$teacher->second_name}}
        </li>
    @endforeach

@stop
