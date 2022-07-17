<?php

use App\Http\Controllers\HomePage;
use App\Services\VisitService;
use Illuminate\Auth\Events\Login;
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

# Guest Routes

Route::get('/', [HomePage::class, 'index'])->name('welcome');
Route::get('/admin', [HomePage::class, 'admin'])->name('admin');

Route::get('/contact-us', function() {
  return view('contact-us');
})->name('contactus');

Route::get('/privacy-policy', function() {
  return view('privacy');
})->name('privacypolice');

Route::get('/gallery', function() {
  return view('gallery');
})->name('gallery');

Route::get('/about-us', [HomePage::class, 'aboutus'])->name('aboutus');

Route::get('/admission', function() {
  return view('admission');
})->name('admission');

Route::get('/jobs', function() {
  return view('jobs');
})->name('jobs');

Route::get('/advert', function() {
  return response()->download(public_path('pdf/advert.pdf', 'FAVOUR-INTERNATIONAL-ADVERT.pdf'));
})->name('advert');

Route::get('/fn2', function() {
  return response()->download(public_path('pdf/fn2.pdf'), 'APPLICATION-FORM-FAVOUR-PRE-AND-PRIMARY-FINAL2.pdf');
})->name('fn2');

Route::get('/pr2', function() {
  return response()->download(public_path('pdf/pr2.pdf'), 'APPLICATION-FORM-FAVOUR-PRE-AND-PRIMARY-2.pdf');
})->name('pr2');