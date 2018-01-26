<?php

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', function () {
    return response(User::all(),200);
});

Route::post('users', function(Request $request) {
    $resp = User::create($request->all());
    return $resp;
});

Route::get('jobs/{search}', function(Request $request, $searchTerm){
    
    $query = "SELECT * FROM business_jobs AS bj
    LEFT JOIN business_additional_datas AS bad 
        ON bj.business_id = bad.user_id
        ORDER BY RAND()
        LIMIT 10";
   
   $products = DB::select($query, []);

    return $products;
});