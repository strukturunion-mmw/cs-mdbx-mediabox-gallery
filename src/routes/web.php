<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ArbeitspaketeController;
use App\Http\Controllers\PlanungsController;
use App\Models\Arbeitspaket;


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
    return Inertia::render('Prognoseplanung');
});

Route::get('/arbeitspakete', [ArbeitspaketeController::class, 'index'])->name("arbeitspakete.index");
Route::post('/arbeitspakete', [ArbeitspaketeController::class, 'index'])->name("arbeitspakete.index");

Route::post('/handle_paket', [ArbeitspaketeController::class, 'handlePaket']);
Route::post('/handle_paket_field', [ArbeitspaketeController::class, 'handleField']);

Route::get('/planung', [PlanungsController::class, 'index'])->name("planung.index");
Route::post('/planung', [PlanungsController::class, 'index'])->name("planung.index");


Route::get('/test', function () {
    dd(Arbeitspaket::first());
});


Route::get('/kanban', function () {
    return Inertia::render('CardsKanban', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/home', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
