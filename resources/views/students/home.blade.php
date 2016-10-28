@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">

            <h1>

                {{$student->first_name}}
                {{$student->second_name}}

            </h1>

        </div>

        <div class="panel-body">

            <ul class="list-unstyled">

                <li> Album number: {{$student->album_number}}</li>
                <li> Project group: {{$student->pr_group}}</li>
                <li> Laboratory group: {{$student->lab_group}}</li>

            </ul>

        </div>
    </div>

    @if(Session::has('success'))

        <div class="alert alert-success text-center">
            {{Session::get('success')}}
        </div>

    @endif

    @if(Session::has('error'))

        <div class="alert alert-danger text-center">
            {{Session::get('error')}}
        </div>

    @endif

@stop
