<?php

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
use App\Http\Controllers\DemoController;

Route::group([], function () {
    Route::get('/test', function () {
        try {
            // 嘗試連接到資料庫
            DB::connection()->getPdo();
            return 'Laravel is working. Connected to the database successfully.';
        } catch (\Exception $e) {
            return 'Laravel is working. Could not connect to the database. Please check your configuration. Error: ' . $e->getMessage();
        }
    });
});
// getData
Route::group([], function () {
    Route::get('/getData', [DemoController::class, 'getData']);
    Route::post('/postData', [DemoController::class, 'postData']);
    Route::patch('/data', [DemoController::class, 'patchData']);
    Route::delete('/deleteData', [DemoController::class, 'deleteData']);
});
