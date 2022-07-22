<?php

use App\Services\VisitService;
use App\Http\Controllers\Login;
use App\Http\Controllers\HomePage;
use App\Http\Controllers\AdminPage;
use App\Models\Gallery;
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
Route::get('/login', [HomePage::class, 'admin'])->name('login');
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth']], function () {
  Route::get('/dashboard', [AdminPage::class, 'dashboard'])->name('dashboard');
  Route::get('/staffs', [AdminPage::class, 'staffs'])->name('staffs');
  Route::get('/new-staffs', [AdminPage::class, 'newstaffs'])->name('newstaffs');
  Route::post('/add-new-staffs', [AdminPage::class, 'addnewstaffs'])->name('addnewstaffs');
  Route::get('/designations', [AdminPage::class, 'designations'])->name('designations');
  Route::get('/departments', [AdminPage::class, 'departments'])->name('departments');
  Route::get('/events', [AdminPage::class, 'events'])->name('events');
  Route::post('/add-department', [AdminPage::class, 'adddepartment'])->name('adddepartment');
  Route::post('/add-designation', [AdminPage::class, 'adddesignation'])->name('adddesignation');
  Route::post('/add-event', [AdminPage::class, 'addevent'])->name('addevent');
  Route::get('/delete-designation/{name?}/{id?}', [AdminPage::class, 'deletedesignation'])->name('deletedesignation');
  Route::get('/delete-department/{name?}/{id?}', [AdminPage::class, 'deletedepartment'])->name('deletedepartment');
  Route::get('/delete-event/{id?}', [AdminPage::class, 'deleteevent'])->name('deleteevent');
  Route::get('/gallery', [AdminPage::class, 'gallery'])->name('gallery');
  Route::post('/imageuploader', [AdminPage::class, 'imageuploader'])->name('imageuploader');
});
Route::post('/postLogin', [Login::class, 'login'])->name('postlogin');
Route::post('/logout', [Login::class, 'logout'])->name('logout');

Route::get('/contact-us', function () {
  return view('contact-us');
})->name('contactus');

Route::get('/privacy-policy', function () {
  return view('privacy');
})->name('privacypolice');

Route::get('/gallery', function () {
  $data['images'] = Gallery::orderBy('id', 'DESC')->get();
  return view('gallery', $data);
})->name('gallery');

Route::get('/about-us', [HomePage::class, 'aboutus'])->name('aboutus');

Route::get('/admission', function () {
  return view('admission');
})->name('admission');

Route::get('/jobs', function () {
  return view('jobs');
})->name('jobs');

Route::get('/advert', function () {
  return response()->download(public_path('pdf/advert.pdf', 'FAVOUR-INTERNATIONAL-ADVERT.pdf'));
})->name('advert');

Route::get('/fn2', function () {
  return response()->download(public_path('pdf/fn2.pdf'), 'APPLICATION-FORM-FAVOUR-PRE-AND-PRIMARY-FINAL2.pdf');
})->name('fn2');

Route::get('/pr2', function () {
  return response()->download(public_path('pdf/pr2.pdf'), 'APPLICATION-FORM-FAVOUR-PRE-AND-PRIMARY-2.pdf');
})->name('pr2');
