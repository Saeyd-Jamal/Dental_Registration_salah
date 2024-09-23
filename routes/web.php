<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('records.index');
})->name('home');


// Route::post('dental/livewire/update', function () {
//     return redirect()->route('home');
// })->name('livewire.update');

require __DIR__.'/dashboard.php';
