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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user', function () {
    global $users;
    return $users;
});

Route::get('/user/{userIndex}', function ($userIndex) {
    global $users;
    if (isset($users[$userIndex])) {
        return $users[$userIndex];
    } else {
        return "cannot find this user with index " . $userIndex;
    }
})->whereNumber('userIndex');

Route::get('/user/{userName}', function ($userName) {
    global $users;
    foreach ($users as $user) {
        if ($userName === $user['name']) {
            return $user;
        }
    }
    if (isset($user)) {
        return "cannot find this user with name " . $userName;
    }
})->whereAlpha('userName');


Route::prefix('/user')->group(function () {

    Route::get('/', function () {
        global $users;
        return $users;
    });

    Route::get('/{userIndex}', function ($userIndex) {
        global $users;
        if (isset($users[$userIndex])) {
            return $users[$userIndex];
        } else {
            return "cannot find this user with index " . $userIndex;
        }
    })->whereNumber('userIndex');

    Route::get('/{userName}', function ($userName) {
        global $users;
        foreach ($users as $user) {
            if ($userName === $user['name']) {
                return $user;
            }
        }
        if (isset($user)) {
            return "cannot find this user with name " . $userName;
        }
    })->whereAlpha('userName');
    Route::get('/{userIndex}/post/{postIndex}', function ($userIndex, $postIndex) {
        global $users;
        if (isset($users[$userIndex])) {
            $user = $users[$userIndex];
            if (isset($users[$postIndex])) {
                return $user['posts'][$postIndex];
            }else{
                return "Cannot find the post with id " . $postIndex . " for user " .  $userIndex;
            }
        };
    });
    Route::fallback(function () {
        return "You cannot get a user like this !";
    });
});
