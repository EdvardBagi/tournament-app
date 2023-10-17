<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <ul>
        <li><a href="{{ url('/') }}">Homepage</a></li>
        <li style="float:right"><a href="{{ url('/login') }}">Login</a></li>
    </ul>
    <div id="divLogin">


    <form method="post" action="{{ url('/login/checkLogin') }}" id="loginForm">
        @csrf
        <input type="email"  name="email" placeholder="Email"/><br>
        <input type="password"  name="password" placeholder="Password"/><br>
        <input type="submit" value="Login" id="login"/>
    </form>
    </div>

</body>
</html>
