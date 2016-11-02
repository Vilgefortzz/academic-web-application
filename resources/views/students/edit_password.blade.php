@extends('layouts.app')

@section('content')

    <div class="col-md-5">
        <form class="form-horizontal" method="post" action="/students/{{$student->id}}">

            {{ csrf_field() }}
            {{method_field('patch')}}

                <div class="form-group">

                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h1>Change your password</h1>
                        </div>

                        <div class="panel-body">

                            <label for="old_password">Old password:</label>
                            <input id="old_password" type="password" name="old_password" style="margin-left: 40px"><br>
                            <label for="password">New password:</label>
                            <input id="password" type="password" name="password" style="margin-left: 35px"><br>
                            <label for="password_confirmation">Confirm password:</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" style="margin-left: 10px">

                        </div>

                    </div>

                    <button type="submit" class="btn-primary">Submit</button>

                </div>
        </form>

        {{--Handle data validation--}}
        @if (count($errors) > 0)
            <div class="alert alert-danger text-center">
                <ul>
                    @foreach ($errors->all() as $error)
                        <b>{{ $error }}</b>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(Session::has('success'))

            <div class="alert alert-success text-center">
                <b>{{Session::get('success')}}</b>
            </div>

        @endif

        @if(Session::has('error'))

            <div class="alert alert-danger text-center">
                <b>{{Session::get('error')}}</b>
            </div>

        @endif

    </div>

@stop