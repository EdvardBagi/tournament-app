<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TournamentController
{
    function findAll() {
        $sql = "SELECT * FROM tournaments";
        return DB::select($sql);
    }
    function insertTournament(Request $req) {
        $tournament = new Tournament(strip_tags($req->nameT), strip_tags($req->year));
        $sql = "INSERT INTO tournaments(name, year) VALUES(?,?)";
        DB::insert($sql,$tournament->getAttributes());
    }
    function deleteTournament(Request $req) {
        $tournament = new Tournament($req->name, $req->year);
        $sql = "DELETE FROM tournaments WHERE name = ? AND year = ?";
        DB::delete($sql,$tournament->getAttributes());
    }
}
