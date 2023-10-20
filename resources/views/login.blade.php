<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name=”viewport” content=”width=device-width, initial-scale=1.0″>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <ul>
        <li><a href="{{ url('/') }}">Homepage</a></li>
        <li style="float:right"><a href="{{ url('/login') }}">Login</a></li>
    </ul>
    <div id="divLogin">
        @if ($message = Session::get('error'))
            <div>
                <h2 style="color: red">{{ $message }}</h2>

            </div>
        @endif


    <form method="post" action="{{ url('/login/checkLogin') }}" id="loginForm">
        @csrf
        <input type="email"  name="email" placeholder="Email"/><br>
        <input type="password"  name="password" placeholder="Password"/><br>
        <input type="submit" value="Login" id="login"/>
    </form>
        <div class="centerDiv" style="width: 300px">
            <p style="font-size: 0.7em">
                email: 'admin@gmail.com', password: 'admin'<br>
                Every user follows the same pattern:<br>
                email: xyz@gmail.com<br>
                password: xyz;<br>
                To see the users login as admin first.
            </p>
        </div>
    </div>
</body>
</html>
