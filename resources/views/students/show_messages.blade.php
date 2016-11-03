@extends('layouts.app')

@section('content')

    @foreach($student->subjects as $subject)

        @foreach($subject->messages as $message)

            {{--Display only these messages from recently month and only for student groups--}}
            @if($messagesFromMonth->contains('id', $message->id))

                 @foreach(explode('|', $message->to_lab_groups) as $lab_group)

                     @if ($lab_group === $student->lab_group)

                         <div class="col-md-4">

                             <div class="panel" style="margin-right: 30px">

                                 <div class="panel-heading text-center" style="background-color: #636b6f; color: ghostwhite">
                                     <i><b>{{$message->subject->name}}: {{$message->header}}</b></i>
                                 </div>

                                 <div class="panel-body">

                                     <small>{{$message->content}}</small>

                                 </div>

                                 <div style="margin-bottom: 0">

                                     <small style="color: darkred; font-size: 70%">
                                         <i>
                                             by:
                                             {{$message->teacher->degree}}
                                             {{$message->teacher->first_name}}
                                             {{$message->teacher->second_name}}
                                         </i>
                                     </small>
                                     <br>

                                     <small style="color: darkslategrey; font-size: 70%">
                                         <i>
                                             added on:
                                             {{$message->created_at}}
                                         </i>
                                     </small>

                                 </div>
                             </div>

                         </div>

                     @endif

                 @endforeach

             @endif


         @endforeach

     @endforeach

 @stop