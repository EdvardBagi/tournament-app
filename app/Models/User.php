<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User
{
    use HasApiTokens, HasFactory, Notifiable;

    private $name;
    private $email;
    private $password;

    function __construct($name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
    function getAttributes() {
        $arr = array();
        array_push($arr, $this->getName(),$this->getEmail(),$this->getPassword());
        return $arr;
    }
    function getName() {
        return $this->name;
    }
    function setName($name) {
        $this->name = $name;
    }
    function getEmail() {
        return $this->email;
    }
    function setEmail($email) {
        $this->email = $email;
    }
    function getPassword() {
        return $this->password;
    }
    function setPassword($password) {
        $this->password = $password;
    }
}
