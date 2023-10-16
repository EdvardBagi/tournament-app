<?php

namespace App\Http\Controllers;

use App\Models\Contestant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContestantController
{
    function findAll() {
        $sql = "SELECT * FROM contestants";
        return DB::select($sql);
    }
    function insertContestant(Request $req) {
        $contestant = new Contestant($req->user, $req->email,$req->round, $req->tournament_name, $req->tournament_year);
        $sql = "INSERT INTO contestants(user_name,user_email, round,tournament_name, tournament_year) VALUES(?,?,?,?,?)";
        DB::insert($sql,$contestant->getAttributes());
    }
    function deleteContestant(Request $req) {
        $name = $req->name;
        $email = $req->email;
        $round = $req->round;
        $tournament_name = $req->tournament_name;
        $tournament_year = $req->tournament_year;

        $sql = "DELETE FROM contestants WHERE user_name = ? AND user_email = ? AND round = ? AND tournament_name = ? AND tournament_year = ?";
        DB::delete($sql,[$name,$email,$round,$tournament_name,$tournament_year]);
    }
}
