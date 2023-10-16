<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\RoundController;
use App\Http\Controllers\ContestantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('homepage');
});
Route::get('/actions', function () {
    return view('actions');
});
Route::get('/login', function () {
    return view('login');
});

Route::post('insertUser',[UserController::class, 'insertUser']);
Route::post('insertTournament',[TournamentController::class, 'insertTournament']);
Route::post('insertRound',[RoundController::class, 'insertRound']);
Route::post('insertContestant',[ContestantController::class, 'insertContestant']);
Route::post('deleteUser',[UserController::class, 'deleteUser']);
Route::post('deleteContestant',[ContestantController::class, 'deleteContestant']);
Route::post('deleteRound',[RoundController::class, 'deleteRound']);
Route::post('deleteTournament',[TournamentController::class, 'deleteTournament']);

