@extends('layouts.app')

@section('content')

    <div class="row">

        <form class="form-horizontal" method="post" action="/students/{{$student->id}}">

            {{ csrf_field() }}
            {{method_field('patch')}}

                <div class="form-group"><br><br><br><br>

                    <div class="panel panel-primary">

                        <div class="panel-heading">
                            <h1>Change your password</h1>
                        </div>

                        <div class="panel-body">

                            <label for="password">New Password:</label>
                            <input id="password" type="password" name="password">

                        </div>

                    </div>

                <button type="submit" class="btn-primary">Confirm</button>

                </div>
        </form>
    </div>

        {{--Obsługa walidacji danych--}}
    @if (count($errors) > 0)
        <div class="alert alert-danger text-center">
            <ul>
                @foreach ($errors->all() as $error)
                    <b>{{ $error }}</b>
                @endforeach
            </ul>
        </div>
    @endif

@stop