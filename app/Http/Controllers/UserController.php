<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController
{
    function findAll() {
        $sql = "SELECT * FROM users";
        return DB::select($sql);
    }
    function insertUser(Request $req) {
        $user = array($req->name, $req->email,$req->password);
        $sql = "INSERT INTO users(name, email, password) VALUES(?,?,?)";
        DB::insert($sql,$user);
    }
    function deleteUser(Request $req) {
        $name = $req->username;
        $email = $req->email;
        $sql = "DELETE FROM users WHERE name= ? AND email = ?";
        DB::delete($sql,[$name,$email]);
    }

    function findUserNameById($id) {
        $sql = "SELECT name FROM users WHERE id = ?";
        return DB::select($sql,[$id]);
    }
    function findUserIdByName($name) {
        $sql = "SELECT id FROM users WHERE name = ?";
        return DB::select($sql,[$name]);
    }
}
