<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contestant
{
    use HasFactory;
    private $user_id;
    private $round;
    private $tournament_name;
    private $tournament_year;


    function __construct($user_id, $round, $tournament_name, $tournament_year) {
        $this->user_id = $user_id;
        $this->round = $round;
        $this->tournament_name = $tournament_name;
        $this->tournament_year = $tournament_year;
    }
    function getAttributes() {
        $arr = array();
        array_push($arr, $this->getUserId(), $this->getRound(), $this->getTournamentName(), $this->getTournamentYear());
        return $arr;
    }
    function getUserId() {
        return $this->user;
    }
    function setUserId($user) {
        $this->user = $user;
    }

    function getRound() {
        return $this->round;
    }
    function setRound($round) {
        $this->round = $round;
    }
    function getTournamentName() {
        return $this->tournament_name;
    }
    function setTournamentName($tournament_name) {
        $this->tournament_name = $tournament_name;
    }
    function getTournamentYear() {
        return $this->tournament_year;
    }
    function setTournamentYear($tournament_year) {
        $this->tournament_year = $tournament_year;
    }
}
