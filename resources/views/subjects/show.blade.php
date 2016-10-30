@extends('layouts.app')

@section('content')

    <div class="col-md-6">

        <div class="panel panel-default">

            <div class="panel-heading">
                <h1><span class="glyphicon glyphicon-blackboard"></span> {{$subject->name}}</h1>
            </div>

            <div class="panel-body">

                <h3 class="text-primary">ECTS: {{$subject->ECTS}}</h3>

                <b>Students:</b><br><br>
                <ul class="list-group">
                    @foreach($subject->students as $student)
                        {{$student->first_name}}
                        {{$student->second_name}},
                    @endforeach
                </ul>

                <b>Teachers:</b><br><br>
                <ul class="list-group">
                    @foreach($subject->teachers as $teacher)
                        {{$teacher->degree}}
                        {{$teacher->first_name}}
                        {{$teacher->second_name}},
                    @endforeach
                </ul>

            </div>

        </div>
    </div>

    {{--Tylko nauczyciel może dodawać pliki do przedmiotu--}}
    @if(Auth::guard('teacher')->check())

        <div class="col-md-5">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h1>Upload files</h1>
                </div>

                <div class="panel-body">

                    <form action="{{route('addentry', $subject->id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="file" name="filefield" accept=".doc, .docx, .txt, .pdf" class="input-lg">
                        <input type="submit" class="btn-primary btn-lg">

                    </form>

                </div>

                @if(Session::has('error'))

                    <div class="alert alert-danger text-center">
                        {{Session::get('error')}}
                    </div>

                @endif

            </div>
        </div>
    @endif

    <div class="col-md-5">

        <div class="panel panel-default">

            <div class="panel-heading">
                <h1>Files</h1>
            </div>

            <div class="panel-body">

                <ul>
                    @foreach($subject->fileentries as $fileentry)
                        <li>
                            <a href="{{route('getentry', $fileentry->original_filename)}}">

                                <span class="glyphicon glyphicon-file"></span>
                                {{$fileentry->original_filename}}

                            </a>
                        </li>

                        <li class="list-unstyled">

                            <small><i>
                                by
                                {{$fileentry->teacher->degree}}
                                {{$fileentry->teacher->first_name}}
                                {{$fileentry->teacher->second_name}}
                                </i></small>

                        </li>

                        <li class="list-unstyled" style="color: darkred">

                            <small><i>
                                    uploaded on
                                    {{$fileentry->created_at}}
                                </i></small>

                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>

@stop