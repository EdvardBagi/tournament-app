<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name=”viewport” content=”width=device-width, initial-scale=1.0″>
    <title>Homepage</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="../js/jquery-3.7.1.js"></script>
    <script>
        $(document).ready( function () {
            $('#bigButton').on('click', function () {
                window.location = '{{url('/actions')}}';
            });
        });

    </script>
</head>
<body>

<ul>
    <li><a href="{{ url('/') }}">Homepage</a></li>
    @if(Auth::user() !== null && Auth::user()->email === "admin@gmail.com")
    <li><a href="{{ url('/actions') }}">Actions</a></li>
    @endif

    @if(isset(Auth::user()->email))
        <li style="float:right"><a href="{{ url('/logout') }}">Logout</a></li>
    @else
        <li style="float:right"><a href="{{ url('/login') }}">Login</a></li>
    @endif
</ul>

<div class="centerDiv">
        <button type="button" id="bigButton">Add Tournament</button>
    @if(Auth::user() === null || Auth::user()->email !== "admin@gmail.com")
        <script>
            $('#bigButton').attr('disabled',true).css('background-color','gray');
        </script>
    <br>
    <div class="centerDiv" style="min-width: 200px;">
        <p style="font-size: 0.7em">
            You have to log in as admin if you want to add tournaments.
            (email: 'admin@gmail.com', password: 'admin')
        </p>
    </div>
    @endif
    <br>
    <table id='centerTable' class='tableStyle'>
        <tr><th>Tournament</th><th>Year</th></tr>
        <?php

        use App\Http\Controllers\TournamentController;

        $tournament_controller = new TournamentController();
        $data = $tournament_controller->findAll();

        foreach ($data as $tournament) {
            echo "<tr>";
            echo "<td>" . $tournament->{'name'} . "</td>";
            echo "<td>" . $tournament->{'year'} . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</div>
</body>
</html>
