<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name=”viewport” content=”width=device-width, initial-scale=1.0″>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="TS" content="{{ url("insertTournament") }}"/>
    <meta name="RS" content="{{ url("insertRound") }}"/>
    <meta name="CS" content="{{ url("insertContestant") }}"/>
    <meta name="US" content="{{ url("insertUser") }}"/>
    <meta name="TD" content="{{ url("deleteTournament") }}"/>
    <meta name="RD" content="{{ url("deleteRound") }}"/>
    <meta name="CD" content="{{ url("deleteContestant") }}"/>
    <meta name="UD" content="{{ url("deleteUser") }}"/>

    <title>Actions</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/handler.js"></script>
</head>
<body>
@if(Auth::user() === null || Auth::user()->email != "admin@gmail.com")
    <script>window.location = "/"</script>
@endif

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
    @if(isset(Auth::user()->email))
        <li style="float:right"><a href="{{ url('/logout') }}">Logout</a></li>
    @else
        <li style="float:right"><a href="{{ url('/login') }}">Login</a></li>
    @endif
</ul>
<div class="addAndList">
    <div class="add">
        <form id="tournamentForm">
            <input type="text" name="nameT" id="nameT" placeholder="Tournament's name" required/><br>
            <input type="number" name="year" id="year" placeholder="Tournament's year" required/><br>
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
                    echo "<option>" . $u->{'id'} . "," . $u->{'name'} . "</option>";
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
                $name = $user_controller->findUserNameById($contestant->{'user_id'});
                echo "<tr>";
                echo "<td hidden>" . $contestant->{'user_id'} . "</td>";
                echo "<td>" . $name[0]->{'name'} . "</td>";
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
    <div class="add">
        <form id="userForm">
            <input type="text" name="userName" id="userName" placeholder="Name"/><br/>
            <input type="email" name="userEmail" id="userEmail" placeholder="Email"/><br/>
            <input type="password" name="userPassword" id="userPassword" placeholder="Password"/><br/>
            <input type="submit" value="Submit User" id="submitUser"/>
        </form>
    </div>
    <div class="list">
        <table class='tableStyle' id="userTable">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user->{'name'} . "</td>";
                echo "<td>" . $user->{'email'} . "</td>";
                if($user->{'name'} != 'admin') {
                    echo "<td><input value='Delete' type='button' class='deleteUser'/></td>";
                } else {
                    echo "<td></td>";
                }
                echo "</tr>";
            }
            ?>
        </table>

    </div>
</div>
</body>
</html>
