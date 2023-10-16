<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Round
{
    use HasFactory;
    private $name;
    private $tournament_name;
    private $tournament_year;

    function __construct($name, $tournament_name, $tournament_year) {
        $this->name = $name;
        $this->tournament_name = $tournament_name;
        $this->tournament_year = $tournament_year;
    }

    function getAttributes() {
        $arr = array();
        array_push($arr, $this->getName(),$this->getTournamentName(),$this->getTournamentYear());
        return $arr;
    }
    function getName() {
        return $this->name;
    }
    function setName($name) {
        $this->name = $name;
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
    function setTournamentYear($year) {
        $this->tournament_year = $year;
    }
}
