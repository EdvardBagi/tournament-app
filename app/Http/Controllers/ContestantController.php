<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContestantController
{
    function findAll() {
        $sql = "SELECT * FROM contestants";
        return DB::select($sql);
    }
    function insertContestant(Request $req) {
        $arr = array();
        array_push($arr,strip_tags($req->id),strip_tags($req->round),strip_tags($req->tournament_name),strip_tags($req->tournament_year));
        $sql = "INSERT INTO contestants(user_id, round,tournament_name, tournament_year) VALUES(?,?,?,?)";
        DB::insert($sql,$arr);
    }
    function deleteContestant(Request $req) {
        $arr = array();
        array_push($arr,$req->id,$req->round,$req->tournament_name,$req->tournament_year);
        $sql = "DELETE FROM contestants WHERE user_id = ? AND round = ? AND tournament_name = ? AND tournament_year = ?";
        DB::delete($sql,$arr);
    }
}
