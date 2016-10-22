@extends('layouts.app')

@section('content')

        <li>
            {{$student->album_number}}
            {{$student->first_name}}
            {{$student->second_name}}
        </li>

@stop