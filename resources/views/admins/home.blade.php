@extends('layouts.app')

@section('content')

    <div class="col-md-8">

        <div class="panel panel-default">
            <div class="panel-heading">

                <h1>

                    <span class="glyphicon glyphicon-dashboard"></span>
                    Your dashboard

                </h1>

            </div>

            <div class="panel-body">

                <span class="glyphicon glyphicon-user"></span>
                {{$admin->name}}

                <h3><b>Informations:</b></h3><br>

                <ul class="list-unstyled">

                    <li><span class="glyphicon glyphicon-globe"></span> Email address: {{$admin->email}}</li>

                </ul>

                <h3><span class="glyphicon glyphicon-education"></span> Create students, teachers and subjects</h3>
                <h3><span class="glyphicon glyphicon-random"></span> Define relationships between them</h3>

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

    </div>

@stop
