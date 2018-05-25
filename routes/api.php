<?php

use Illuminate\Http\Request;
use App\Models\Stok;

// Route::get('/stok', function () {
//     return StokResource::collection(Stok::all());
// });

// Route::get('/stok', function () {
//     return new StokResource(Stok::find(1));
// });

// Route::get('/stoks', function () {
//     return new StokCollection(Stok::all());
// });



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

Route::middleware('auth:api')->get('/stoks', function (Request $request) {
    return $request->stoks();
});

Route::apiResource('stoks', 'Api/StokApiController');
Route::get('getstoks', 'Api\StokApiController@getAllStok');

Route::post('getstokitem', 'Api\StokApiController@getStokItem');

