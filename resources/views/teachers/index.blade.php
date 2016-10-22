@extends('layouts.app')

@section('content')

    @foreach($teachers as $teacher)
        <li class="list-group-item">
            {{$teacher->degree}}
            {{$teacher->first_name}}
            {{$teacher->second_name}}
        </li>
    @endforeach

@stop
