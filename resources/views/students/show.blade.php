@extends('layouts.main')

@section('header')

    <title>Id_{{$student->id}}</title>

@stop

@section('content')

        <li>
            {{$student->album_number}}
            {{$student->first_name}}
            {{$student->second_name}}
        </li>

@stop