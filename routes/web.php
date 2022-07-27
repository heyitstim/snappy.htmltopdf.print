<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use App\Models\DailyTimeRecord;
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
    return view('auth.login');
});

require __DIR__ . '/auth.php';

Route::resource('dtrform', FormController::class)->middleware('auth');
Route::get('/dtr',[FormController::class,'index'])->middleware('auth')->name('dtr');

Route::get('/wkhtmltopdf', [FormController::class, 'print_form'])->name('print_data');

Route::get('/createdtr', function () {
    return view('create');
})->middleware('auth')->name('createdtr');
