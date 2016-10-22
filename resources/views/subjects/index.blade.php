@extends('layouts.app')

@section('content')

    <h1 class="well">All subjects</h1>

    <ul class="list-group">

        @foreach($subjects as $subject)
            <li class="list-group-item">
                {{$subject->name}}
            </li>
        @endforeach
    </ul>

@stop