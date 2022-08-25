<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\NewQuestion;

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

Route::prefix('_v1')->group(function () {
    Route::post('/question', function (Request $request) {
        if ($request->has('question') && $request->has('uid')) {
            event(new NewQuestion($request->input('uid'), $request->input('question')));
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['error' => 'Missing parameters'], 400);
        }
    });
});
