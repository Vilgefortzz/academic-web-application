<html>
<head></head>
<body>
<div class="well">

    <b>Below is link to reset your password:</b><br><br>

    <a href="{{url('/reset/password/temp/'. $email)}}">
        {{$secureString}}
    </a>

</div>
</body>
</html>