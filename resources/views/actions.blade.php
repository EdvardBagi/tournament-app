<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>Operations</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="../js/jquery-3.7.1.js"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers:
                    {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
            });
            $('#submitTournament').on('click', function (e) {
                e.preventDefault();
                let name = $('#nameT').val();
                let year = $('#year').val();

                $.ajax({
                    type: 'POST',
                    url: '{{ url("insertTournament") }}',
                    data: {'nameT': name, 'year': year},
                    success: function () {
                        $('#tournamentForm')[0].reset();
                        $('#tournamentTable').load(document.URL + ' #tournamentTable');
                        $('#roundForm').load(document.URL + ' #roundForm');
                    },
                    error: function () {
                        alert('Tournament already exists.');
                    }
                });
            });
        });
        $(document).on('click', '#submitRound', function (e) {
            e.preventDefault();
            let name = $('#nameR').val();
            let both = $('#both option:selected').text();
            let arr = both.split(",");
            let name2 = arr[0];
            let year = arr[1];
            $.ajax({
                type: 'POST',
                url: '{{ url("insertRound") }}',
                data: {'nameR': name, 'nameTournament': name2, 'year': year},
                success: function () {
                    $('#roundForm').load(document.URL + ' #roundForm');
                    $('#roundTable').load(document.URL + ' #roundTable');
                    $('#contestantForm').load(document.URL + ' #contestantForm');
                },
                error: function () {
                    alert('Round for this tournament already exists.');
                }
            });
        });
        $(document).on('click', '#submitContestant', function (e) {
            e.preventDefault();
            let name = $('#user option:selected').text();
            let round = $('#round option:selected').text();
            let list = name.split(",");
            let arr = round.split(",");
            $.ajax({
                type: 'POST',
                url: '{{ url("insertContestant") }}',
                data: {'user': list[0],'email': list[1],'round': arr[0],'tournament_name':arr[1],'tournament_year':arr[2]},
                success: function () {
                    $('#contestantForm').load(document.URL + ' #contestantForm');
                    $('#contestantTable').load(document.URL + ' #contestantTable');
                },
                error: function () {
                    alert('Contestant to this round and tournament already exists.');
                }
            });
        });

        //DELETES
        $(document).on('click', '.deleteTournament', function (e) {
            e.preventDefault();
            let row = $(this).closest('tr');
            let nameT = row.find('td:nth-child(1)').text();
            let yearT = row.find('td:nth-child(2)').text();
            console.log(nameT, yearT);
            $.ajax({
                type: 'POST',
                url: '{{ url("deleteTournament") }}',
                data: {'name': nameT, 'year': yearT},
                success: function () {
                    $('#tournamentTable').load(document.URL + ' #tournamentTable');
                    $('#roundForm').load(document.URL + ' #roundForm');
                    $('#roundTable').load(document.URL + ' #roundTable');
                    $('#contestantTable').load(document.URL + ' #contestantTable');
                    $('#contestantForm').load(document.URL + ' #contestantForm');
                }
            });
        });
        $(document).on('click', '.deleteRound', function (e) {
            e.preventDefault();
            let row = $(this).closest('tr');
            let round = row.find('td:nth-child(1)').text();
            let TName = row.find('td:nth-child(2)').text();
            let TYear = row.find('td:nth-child(3)').text();
            $.ajax({
                type: 'POST',
                url: '{{ url("deleteRound") }}',
                data: {'round': round, 'TName': TName, 'TYear': TYear},
                success: function () {
                    $('#roundTable').load(document.URL + ' #roundTable');
                    $('#contestantTable').load(document.URL + ' #contestantTable');
                    $('#contestantForm').load(document.URL + ' #contestantForm');
                }
            });
        });
        $(document).on('click', '.deleteContestant', function (e) {
            e.preventDefault();
            let row = $(this).closest('tr');
            let name = row.find('td:nth-child(1)').text();
            let email = row.find('td:nth-child(2)').text();
            let round = row.find('td:nth-child(3)').text();
            let tournament_name = row.find('td:nth-child(4)').text();
            let tournament_year = row.find('td:nth-child(5)').text();
            $.ajax({
                type: 'POST',
                url: '{{ url("deleteContestant") }}',
                data: {'name': name,'email': email, 'round': round,'tournament_name':tournament_name,'tournament_year':tournament_year},
                success: function () {
                    $('#contestantTable').load(document.URL + ' #contestantTable');
                }
            });
        });
        $(document).on('click', '.deleteUser', function (e) {
            e.preventDefault();
            let row = $(this).closest('tr');
            let name = row.find('td:nth-child(1)').text();
            let email = row.find('td:nth-child(2)').text();
            console.log(name, email);
            $.ajax({
                type: 'POST',
                url: '{{ url("deleteUser") }}',
                data: {'username': name, 'email': email},
                success: function () {
                    $('#userTable').load(document.URL + ' #userTable');
                    $('#contestantTable').load(document.URL + ' #contestantTable');
                    $('#contestantForm').load(document.URL + ' #contestantForm');
                }
            });
        });
    </script>
</head>
<body>
<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\RoundController;
use App\Http\Controllers\ContestantController;
use App\Http\Controllers\TournamentController;

$user_controller = new UserController();
$users = $user_controller->findAll();
$round_controller = new RoundController();
$rounds = $round_controller->findAll();
$contestant_controller = new ContestantController();
$contestants = $contestant_controller->findAll();
$tournament_controller = new TournamentController();
$tournaments = $tournament_controller->findAll();
?>
<ul>
    <li><a href="{{ url('/') }}">Homepage</a></li>
    <li><a href="{{ url('/actions') }}">Actions</a></li>
    <li style="float:right"><a href="{{ url('/login') }}">Login</a></li>
</ul>
<div class="addAndList">
    <div class="add">
        <form id="tournamentForm">
            <input type="text" name="nameT" id="nameT" placeholder="Tournament's name"/><br>
            <input type="number" name="year" id="year" placeholder="Tournament's year"/><br>
            <input type="submit" value="Add Tournament" id="submitTournament"/>
        </form>
    </div>
    <div class="list" id="tournamentDiv">
        <table class="tableStyle" id="tournamentTable">
            <tr>
                <th>Tournament</th>
                <th>Year</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($tournaments as $tournament) {
                echo "<tr>";
                echo "<td>" . $tournament->{'name'} . "</td>";
                echo "<td>" . $tournament->{'year'} . "</td>";
                echo "<td><input value='Delete' type='button' class='deleteTournament'/></td>";
                echo "</tr>";
            }
            ?>
        </table>

    </div>
</div>
<hr>
<div class="addAndList">
    <div class="add">
        <form id="roundForm">
            <input type="text" name="nameR" id="nameR" placeholder="Round's name"/><br>
            <select id="both">
                <option value="" disabled selected hidden>Select Tournament</option>
                <?php
                foreach ($tournaments as $tn) {
                    echo "<option>" . $tn->{'name'} . "," . $tn->{'year'} . "</option>";
                }
                ?>
            </select><br>
            <input type="submit" value="Add Round" id="submitRound"/>
        </form>
    </div>
    <div class="list">
        <table class='tableStyle' id="roundTable">
            <tr>
                <th>Round</th>
                <th>Tournament</th>
                <th>Year</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($rounds as $round) {
                echo "<tr>";
                echo "<td>" . $round->{'name'} . "</td>";
                echo "<td>" . $round->{'tournament_name'} . "</td>";
                echo "<td>" . $round->{'tournament_year'} . "</td>";
                echo "<td><input value='Delete' type='button' class='deleteRound'/></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>
<hr>
<div class="addAndList">
    <div class="add">
        <form id="contestantForm">
            <select id="user">
                <option value="" disabled selected hidden>Select User</option>
                <?php
                foreach ($users as $u) {
                    echo "<option>" . $u->{'name'} . "," . $u->{'email'} . "</option>";
                }
                ?>
            </select><br>
            <select name="nameRR" id="round">
                <option value="" disabled selected hidden>Select Round</option>
                <?php
                foreach ($rounds as $rn) {
                    echo "<option>" . $rn->{'name'} . "," . $rn->{'tournament_name'} . "," . $rn->{'tournament_year'} . "</option>";
                }
                ?>
            </select><br>
            <input type="submit" value="Add Contestant" id="submitContestant"/>
        </form>
    </div>
    <div class="list">
        <table class='tableStyle' id="contestantTable">
            <tr>
                <th>User</th>
                <th>Round</th>
                <th>Tournament</th>
                <th>Year</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($contestants as $contestant) {
                echo "<tr>";
                echo "<td>" . $contestant->{'user_name'} . "</td>";
                echo "<td style='display:none;'>" . $contestant->{'user_email'} . "</td>";
                echo "<td>" . $contestant->{'round'} . "</td>";
                echo "<td>" . $contestant->{'tournament_name'} . "</td>";
                echo "<td>" . $contestant->{'tournament_year'} . "</td>";
                echo "<td><input value='Delete' type='button' class='deleteContestant'/></td>";
                echo "</tr>";
            }
            ?>
        </table>

    </div>
</div>
<hr>
<div class="addAndList">
    <div class="list">
        <table class='tableStyle' id="userTable">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user->{'name'} . "</td>";
                echo "<td>" . $user->{'email'} . "</td>";
                echo "<td>" . $user->{'password'} . "</td>";
                echo "<td><input value='Delete' type='button' class='deleteUser'/></td>";
                echo "</tr>";
            }
            ?>
        </table>

    </div>
</div>
</body>
</html>
