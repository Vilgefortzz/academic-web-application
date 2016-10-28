@extends('layouts.app')

@section('content')

            <div class="panel panel-default" style="margin-top: 80px">
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

                        <h4><b>Assign marks</b></h4>

                    </div>

                    <div class="col-md-3">

                        <h4><b>Send emails to students</b></h4>

                    </div>

                    <div class="col-md-3">

                        <h4><b>Check your marks and subjects</b></h4>

                    </div>

                </div>
            </div>

        @if(Session::has('error'))

            <div class="alert alert-danger text-center">
                {{Session::get('error')}}
            </div>

        @endif

@stop
