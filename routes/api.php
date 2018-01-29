<?php

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::get('users', function () {
    return response(User::all(),200);
});

Route::post('users', function(Request $request) {
    $resp = User::create([
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'type' => $request->type
    ]);
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