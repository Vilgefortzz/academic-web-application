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
                {{$student->first_name}}
                {{$student->second_name}}

                <h3><b>Informations:</b></h3><br>

                <ul class="list-unstyled">

                    <li><span class="glyphicon glyphicon-list-alt"></span> Album number: {{$student->album_number}}</li>
                    <li><span class="glyphicon glyphicon-modal-window"></span> Project group: {{$student->pr_group}}</li>
                    <li><span class="glyphicon glyphicon-modal-window"></span> Laboratory group: {{$student->lab_group}}</li>

                    <li><span class="glyphicon glyphicon-globe"></span> Email address: {{$student->email}}</li>

                </ul>

                <h3><span class="glyphicon glyphicon-envelope"></span> Check messages from your subjects</h3>

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
