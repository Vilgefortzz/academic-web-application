@extends('layouts.main')

@section('header')

    <title>Id_{{$teacher->id}}</title>

@stop

@section('content')

    <div class="row">

        <form method="post" action="/teachers/{{$teacher->id}}">

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