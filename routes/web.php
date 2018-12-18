<?php

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
  return view('front.welcome');
});

Route::get('/form', function () {
  return view('front.form1');
});

Route::get('/events', function () {
  return view('front.events');
});

Route::get('/gallery', function () {
  return view('front.gallery');
});

Route::get('/contact', function () {
  return view('front.contact');
});

Route::get('/services', function () {
  return view('front.services');
});

Route::get('/dashboard', function () {
  return view('dashboard.dashboard');
});

Route::get('/404', function () {
  return view('dashboard.404');
});

/*
Route::get('/login', function () {
  return view('dashboard.login');
});
*/

Route::get('test', 'TestController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/passreset', 'HomeController@index')->name('password.reset');

Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');


Route::get('/admin', 'AdminController@admin')
->middleware('is_admin')
->name('admin');

Route::prefix('admin')->group(function() {

  Route::get('/dashboard1', 'AdminController@index')->name('admin.home');
});
