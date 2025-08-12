<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\MomController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\UserAttendeeController;

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login',    [AuthController::class, 'login']);
Route::post('auth/refresh',  [AuthController::class, 'refresh']);

Route::middleware('auth:api')->group(function () {
    Route::get('auth/me',      [AuthController::class, 'me']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('admin/ping', fn () => response()->json(['ok' => true]))
    ->middleware(\App\Http\Middleware\RoleMiddleware::class . ':admin');



    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('meetings', MeetingController::class);
    Route::apiResource('rooms', RoomController::class);
    Route::apiResource('features', FeatureController::class);
    Route::apiResource('moms', MomController::class);
    Route::apiResource('notes', NoteController::class);
    Route::apiResource('notifications', NotificationController::class);
    Route::apiResource('invitations', InvitationController::class);
    Route::apiResource('user-attendees', UserAttendeeController::class);

    
});

