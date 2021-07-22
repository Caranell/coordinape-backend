<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\NominationController;
use App\Http\Controllers\CircleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EpochController;
use App\Http\Controllers\UserController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('{circle_id}')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::put('/circles/{circle}', [CircleController::class, 'updateCircle']);
        Route::put('/users/{address}', [UserController::class, 'adminUpdateUser']);
        Route::post('/users', [UserController::class, 'createUser']);
        Route::delete('/users/{address}', [UserController::class, 'deleteUser']);
        Route::post('/epoches', [EpochController::class, 'createEpoch']);
        Route::post('/v2/epoches', [EpochController::class, 'newCreateEpoch']);
        Route::put('/epoches/{epoch}', [EpochController::class, 'updateEpoch']);
        Route::delete('/epoches/{epoch}', [EpochController::class, 'deleteEpoch']);
        Route::post('/upload-logo', [CircleController::class, 'uploadCircleLogo']);

    });
    Route::get('/circles', [CircleController::class, 'getCircles']);
    Route::get('/users/{address}', [UserController::class, 'getUser2']);
    Route::get('/users', [UserController::class, 'getUsers']);
    Route::put('/users/{address}', [UserController::class, 'updateUser']);
    Route::get('/pending-token-gifts', [DataController::class, 'getPendingGifts']);
    Route::get('/token-gifts', [DataController::class, 'getGifts']);
    Route::post('/v2/token-gifts/{address}', [DataController::class, 'newUpdateGifts']);
    Route::post('/teammates', [DataController::class, 'updateTeammates']);
    Route::get('/csv', [DataController::class, 'generateCsv']);
    Route::get('/burns', [DataController::class, 'burns']);
    Route::post('/nominees', [NominationController::class, 'createNominee']);
    Route::get('/nominees', [NominationController::class, 'getNominees']);
    Route::post('/vouch', [NominationController::class, 'addVouch']);
    Route::get('/epoches',[EpochController::class, 'epoches']);

});

Route::post('/upload-avatar/{address}', [ProfileController::class, 'uploadProfileAvatar']);
Route::post('/upload-background/{address}', [ProfileController::class, 'uploadProfileBackground']);
Route::get('/profile/{address}',[ProfileController::class, 'getProfile']);
Route::post('/profile/{address}',[ProfileController::class, 'saveProfile']);

Route::get('/protocols', [DataController::class, 'getProtocols']);
Route::get('/circles', [CircleController::class, 'getCircles']);
//// not used for now
//Route::post('/circles', [CircleController::class, 'createCircle']);
////

Route::get('/users/{address}', [UserController::class, 'getUser']);
Route::get('/users', [UserController::class, 'getUsers']);
Route::get('/token-gifts', [DataController::class, 'getGifts']);
Route::get('/pending-token-gifts', [DataController::class, 'getPendingGifts']);
Route::get('/active-epochs',[EpochController::class, 'getActiveEpochs']);

Route::post("/".config('telegram.token')."/bot-update", [BotController::class,'webHook']);

Route::post('/discord-bot', [BotController::class, 'discordTest']);
Route::fallback(function(){
    return response()->json(['message' => 'Endpoint Not Found'], 404);
})->name('api.fallback.404');

