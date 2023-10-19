<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    function findAll() {
        $sql = "SELECT * FROM users";
        return DB::select($sql);
    }
    function insertUser(Request $req) {
        $this->validate($req, [
            'name' => 'required',
            'email'   => 'required|email',
            'password'  => 'required|alphaNum|min:3'
        ]);

        User::create([
            'name'    => strip_tags($req->name),
            'email'    => strip_tags($req->email),
            'password'   =>  Hash::make(strip_tags($req->password)),
            //'remember_token' =>  str_random(10),
        ]);
        //$user = array(strip_tags($req->name), strip_tags($req->email),strip_tags($req->password));
        //$sql = "INSERT INTO users(name, email, password) VALUES(?,?,?)";
        //DB::insert($sql,$user);
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
    /*function findUserIdByName($name) {
        $sql = "SELECT id FROM users WHERE name = ?";
        return DB::select($sql,[$name]);
    }*/
}
