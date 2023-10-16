<?php

namespace App\Http\Controllers;

use App\Models\Round;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoundController
{
    function findAll() {
        $sql = "SELECT * FROM rounds";
        return DB::select($sql);
    }
    function insertRound(Request $req) {
        $round = new Round($req->nameR, $req->nameTournament, $req->year);
        $sql = "INSERT INTO rounds(name,tournament_name, tournament_year) VALUES(?,?,?)";
        DB::insert($sql,$round->getAttributes());
    }
    function deleteRound(Request $req) {
        $round = new Round($req->round,$req->TName,$req->TYear);
        $sql = "DELETE FROM rounds WHERE name = ? AND tournament_name = ? AND tournament_year = ?";
        DB::delete($sql,$round->getAttributes());
    }
}
