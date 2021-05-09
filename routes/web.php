<?php

use App\Http\Livewire\DashboardPage;
use App\Http\Livewire\IndexPage;
use App\Http\Livewire\Landing;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group( function () {
    Route::get('/landing', Landing::class)->name('landing');
    Route::get('/dashboard', DashboardPage::class)->name('dashboard');
    Route::get('/index', IndexPage::class)->name('index');

});

