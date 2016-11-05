@extends('layouts.app')

@section('content')

    <div class="col-md-4">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h1>Add new message</h1>
            </div>

            <div class="panel-body">

                <form name="grade_form" action="{{route('addmessage', [])}}" method="post">
                    {{ csrf_field() }}

                    <h3 class="well">Send to project groups or laboratory groups??</h3>

                    <div class="well text-center">

                        <label for="proj">To project groups</label>
                        <input type="radio" id="proj" name="destination" value="proj"><br>
                        <label for="lab">To laboratory groups</label>
                        <input type="radio" id="lab" name="destination" value="lab"><br>

                    </div>

                        <div id="option-content-proj">

                            <div class="well text-center">
                                <select class="selectpicker" name="project[]" id="project" multiple title="Choose group/groups">

                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>


                                </select>
                            </div>
                        </div>

                    <div id="option-content-lab">

                        <div class="well text-center">
                            <select class="selectpicker" name="laboratory[]" id="laboratory" multiple title="Choose group/groups">

                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>

                            </select>
                        </div>
                    </div>

                    <label for="subject">To subject:</label><br>
                    <select class="selectpicker" name="subject" id="subject" onclick="sortList('subject')">

                        @foreach($teacher->subjects as $subject)

                            <option value="{{$subject->id}}">{{$subject->name}}</option>

                        @endforeach

                    </select>
                    <br>

                    <label for="header">Header:</label>
                    <br>
                    <textarea name="header" id="header" style="width: 100%" required></textarea>
                    <br>

                    <label for="content">Content:</label>
                    <br>
                    <textarea name="content" id="content" style="width: 100%" required></textarea>
                    <br>

                    <button class="btn">Add a message</button>

                </form>

            </div>

            @if(Session::has('error'))

                <div class="alert alert-danger text-center">
                    <b>{{Session::get('error')}}</b>
                </div>

            @endif

            @if(Session::has('success'))

                <div class="alert alert-success text-center">
                    <b>{{Session::get('success')}}</b>
                </div>

            @endif

        </div>
    </div>

    <div class="col-md-7">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h1>Added messages by you</h1>
            </div>

            <div class="panel-body">

                @foreach($teacher->messages as $message)

                    <div class="option-heading thumbnail">

                        <span class="glyphicon glyphicon-envelope"></span> {{$message->header}}
                        <div class="arrow-up" style="display: inline"><span class="glyphicon glyphicon-menu-up"></span></div>
                        <div class="arrow-down" style="display: inline"><span class="glyphicon glyphicon-menu-down"></span></div>

                    </div>

                    <div class="option-content">

                        <b>Subject:</b> {{$message->subject->name}}<br>
                        <b>Content:</b> {{$message->content}}<br>
                        <b>Project groups:</b> {{$message->to_proj_groups}}<br>
                        <b>Laboratory groups:</b> {{$message->to_lab_groups}}<br>
                        <b style="color: #29b270">Added on:</b> {{$message->created_at}}

                            <form name="delete-message-form" id="delete-message-form{{$message->id}}" method="post" action="{{route('deletemessage', $message->id)}}">
                                {{ csrf_field() }}
                                {{method_field('delete')}}

                                <a id="{{$message->id}}" href="#delete-message-form{{$message->id}}"
                                   onclick="event.preventDefault();
                                           document.getElementById('delete-message-form{{$message->id}}').submit();">

                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>

                            </form>

                    </div>
                @endforeach
            </div>

        </div>
    </div>

    {{--Sort options by some condition--}}
    <script src="/js/sort.js"></script>

    {{--Hide/show content--}}
    <script>

        $(document).ready(function() {

            $("#option-content-proj").hide();
            $("#option-content-lab").hide();

            $('input[name=destination]').click(function () {
                if (this.id == "proj") {
                    $("#option-content-proj").show('slow');
                    $("#option-content-lab").hide();
                } else if (this.id == "lab"){
                    $("#option-content-lab").show('slow');
                    $("#option-content-proj").hide();
                }
            });

        });

    </script>

    {{--Hide/show list--}}
    <script>

        $(document).ready(function() {
            $(".option-content").hide();
            $(".arrow-up").hide();
            $(".option-heading").click(function(){
                $(this).next(".option-content").slideToggle(500);
                $(this).find(".arrow-up, .arrow-down").toggle();
            });
        });

    </script>

@stop