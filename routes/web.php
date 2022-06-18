<?php

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

Route::get('/', function() {
  return view('landing');
})->name('welcome');

Route::get('/contact-us', function() {
  return view('contact-us');
})->name('contactus');

Route::get('/privacy-policy', function() {
  return view('privacy');
})->name('privacypolice');

Route::get('/gallery', function() {
  return view('gallery');
})->name('gallery');

Route::get('/about-us', function() {
  return view('aboutus');
})->name('aboutus');

Route::get('/admission', function() {
  return view('admission');
})->name('admission');

Route::get('/jobs', function() {
  return view('jobs');
})->name('jobs');