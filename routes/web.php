<?php

use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\StepStatusController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\TimelineController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Recruiter;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting', function () {
    $users = Recruiter::all();
    return $users;
});

Route::post('/v1/recruiter/create', [RecruiterController::class, 'create']);
Route::post('/v1/timeline/create', [TimelineController::class, 'create']);
Route::post('/v1/step/create', [StepController::class, 'create']);
Route::post('/v1/step_status/create', [StepStatusController::class, 'create']);
Route::get('/v1/timeline/fetch/{timeline_id}', [TimelineController::class, 'fetch']);
