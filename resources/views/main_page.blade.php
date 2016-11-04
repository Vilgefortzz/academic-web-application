@extends('layouts.app')

@section('content')

    @if(Session::has('success'))

        <div class="alert alert-success text-center" style="margin-top: 60px">
            <b>{{Session::get('success')}}</b>
        </div>

    @endif

    <div class="panel panel-default" style="margin-top: 70px">
        <div class="panel-heading main-header">
            <h1 class="h1-sub text-center main-header">
                Virtual University
            </h1>
        </div>

        <div class="panel-body text-center sub_bacground">

            <br><br>
            <div class="col-md-3">

                <h4><b>Login as student or teacher</b></h4>

            </div>

            <div class="col-md-3">

                <h4><b>Assign grades</b></h4>

            </div>

            <div class="col-md-3">

                <h4><b>Send messages and emails to students</b></h4>

            </div>

            <div class="col-md-3">

                <h4><b>Check your marks and subjects</b></h4>

            </div>

            <div class="col-md-2">

                <h4><b>Upload files for students</b></h4>

            </div>

        </div>
    </div>

    @if(Session::has('error'))

        <div class="alert alert-danger text-center">
            {{Session::get('error')}}
        </div>

    @endif

@stop
