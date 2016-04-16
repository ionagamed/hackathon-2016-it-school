<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    if (!$request->has("ts_end")) {
        $ts_end = "9999-01-01 00:00:00";
    } else {
        $ts_end = $request->input("ts_end");
    }
    if (!$request->has("ts_begin")) {
        $ts_begin = "0000-01-01 00:00:00";
    } else {
        $ts_begin = $request->input("ts_begin");
    }
    $users = \App\User::where("login", "LIKE", "%".$request->input("search")."%")
        ->where("ts_begin", "<=", $ts_end)
        ->where("ts_end", ">=", $ts_begin)
        ->paginate(10);
    $request->flashOnly("search", "ts_begin", "ts_end");
    return view("main", [
        "users" => $users
    ]);
});
