<?php

use App\Http\Livewire\Matriculas;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', Matriculas::class)->name('matriculas');
