@extends('layouts.app')

<!-- Main Content -->
@section('content')

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default" style="margin-top: 80px;">
            <div class="panel-heading">
                Confirm reset password for email: {{$email}}
            </div>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <b>Submit the button to reset password.</b><br>
                    <b>Then we will send you mail with your new password.</b><br><br>

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/reset/password/new/'. $email) }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
