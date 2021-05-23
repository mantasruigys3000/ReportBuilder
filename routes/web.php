<?php

use App\Http\Livewire\ChartsPage;
use App\Http\Livewire\DashboardPage;
use App\Http\Livewire\IndexPage;
use App\Http\Livewire\Landing;
use Illuminate\Support\Facades\Auth;
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
    return redirect('/login');
});

Route::get('/logoutuser',function (\Illuminate\Http\Request $request){
    Auth::logout();
    //dd($request);
    $request->session()->invalidate();

    $request->session()->regenerateToken();
    return redirect('/login');
});

Route::middleware(['auth:sanctum', 'verified'])->group( function () {


    //Route::get('/landing', Landing::class)->name('landing');

    Route::get('/dashboard', DashboardPage::class)->name('dashboard');
    Route::get('/index', IndexPage::class)->name('index');
    Route::get('/chartspage', ChartsPage::class)->name('chartspage');

    Route::prefix('viewchart')->group(function(){
        Route::get('/typecount',\App\Http\Livewire\ViewTypeCount::class)->name('typecount');
        Route::get('/ageovertime',\App\Http\Livewire\ViewAgeOverTimeChart::class)->name('ageovertime');
    });

});

