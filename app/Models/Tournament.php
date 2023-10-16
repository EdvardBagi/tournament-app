<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tournament
{
    use HasFactory;

    private $name;
    private $year;

    function __construct($name, $year)
    {
        $this->name = $name;
        $this->year = $year;
    }

    function getAttributes() {
        $arr = array();
        array_push($arr, $this->getName(),$this->getYear());
        return $arr;
    }
    function getName() {
        return $this->name;
    }
    function setName($name) {
        $this->name = $name;
    }
    function getYear() {
        return $this->year;
    }
    function setYear($year) {
        $this->year = $year;
    }
}
