@extends('layouts.main')

@section('header')

    <title>Id_{{$student->id}}</title>

@stop

@section('content')

    <div class="row">

        <form method="post" action="/students/{{$student->id}}">

            {{ csrf_field() }}
            {{method_field('patch')}}

                <div class="form-group"><br><br><br><br>

                    <div class="panel panel-primary">

                        <div class="panel-heading text-center">
                            <h1>Change your password</h1>
                        </div><br><br>

                        <div class="text-center">
                            <label for="password">New Password:</label>
                            <input id="password" type="password" name="password">
                        </div><br><br>

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