<?php

use App\Http\Controllers\ConstantController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\UserController;
use App\Models\Record;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home')->middleware('auth');


Route::post('records/print', [RecordController::class,'print'])->middleware('auth')->name('records.print');
Route::post('records/printMali', [RecordController::class,'printMali'])->middleware('auth')->name('records.printMali');

Route::resource('records', RecordController::class)->middleware('auth');

Route::resource('users', UserController::class)->middleware(['auth', 'checkTypeUser']);

Route::resource('constants', ConstantController::class)->middleware(['auth', 'checkTypeUser']);
