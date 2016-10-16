@extends('layouts.main')

@section('header')

    <title>Id_{{$student->id}}</title>

@stop

@section('content')

    <div class="row">

        <form method="post" action="/students/{{$student->id}}">

            {{--Trzeba powiedzieć jakiego żądania będziemy wymagać--}}
            {{method_field('patch')}}
            {{--Needed!!!--}}
            {{ csrf_field() }}

            <textarea class="form-control" name="password"></textarea>
            <br>
            <button type="submit" class="btn-sm">Change the password</button>

        </form>
    </div>

@stop