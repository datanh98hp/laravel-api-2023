<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\dumyApi;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get("data",[dumyApi::class,'getData']);

// Route::get('devices',[DeviceController::class,'list']);
// Route::post("devices",[DeviceController::class,'add']);
// Route::put("/device/update/{id}",[DeviceController::class,'update']);
// Route::delete("/device/delete/{id}", [DeviceController::class, 'delete']);
// Route::get("/devices/search/{key}",[DeviceController::class, 'search']);

/// using Resource
// Route::apiResource("member", MemberController::class);

Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::apiResource("member", MemberController::class);

    //
    Route::get('devices', [DeviceController::class, 'list']);
    Route::post("devices", [DeviceController::class, 'add']);
    Route::put("/device/update/{id}", [DeviceController::class, 'update']);
    Route::delete("/device/delete/{id}", [DeviceController::class, 'delete']);
    Route::get("/devices/search/{key}", [DeviceController::class, 'search']);

});
// Route::apiResource("member", MemberController::class)->middleware(['middleware' => 'auth:sanctum']);
Route::post("login",[UserController::class,'index']);
Route::post("upload", [FileController::class, 'upload']);