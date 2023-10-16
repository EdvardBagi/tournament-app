<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<ul>
    <li><a href="{{ url('/') }}">Homepage</a></li>
    <li><a href="{{ url('/actions') }}">Actions</a></li>
    <li style="float:right"><a href="{{ url('/login') }}">Login</a></li>
</ul>

    <div class="centerDiv">
        <?php
            use App\Http\Controllers\TournamentController;

            $tournament_controller= new TournamentController();
            $data = $tournament_controller->findAll();

            echo "<table id='centerTable' class='tableStyle'>";
            echo "<tr><th>Tournament</th><th>Year</th></tr>";
            foreach ($data as $tournament) {
                echo "<tr>";
                echo "<td>" . $tournament->{'name'} . "</td>";
                echo "<td>" . $tournament->{'year'} . "</td>";
                echo "</tr>";
            }
            echo "</table>"
        ?>
    </div>
</body>
</html>
