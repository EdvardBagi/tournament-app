<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class UserController
{
    function findAll() {
        $sql = "SELECT * FROM users";
        return DB::select($sql);
    }
    function insertUser(Request $req) {
        $user = new User($req->name, $req->email,$req->password);
        $sql = "INSERT INTO users(name, email, password) VALUES(?,?,?)";
        DB::insert($sql,$user->getAttributes());
    }
    function deleteUser(Request $req) {
        $name = $req->username;
        $email = $req->email;
        $sql = "DELETE FROM users WHERE name= ? AND email = ?";
        DB::delete($sql,[$name,$email]);
    }
}
