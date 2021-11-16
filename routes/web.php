<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

//Auth::routes(['verify' => true]);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')/*->middleware('verified')*/;


//Clientes
Route::resource('clients', 'ClientController')->middleware('auth');

Route::resource('trainers', 'TrainerController')->middleware('auth');

Route::resource('reservations', 'ReservationController')->middleware('auth');

Route::resource('profiles', 'ProfileController')->middleware('auth');

Route::resource('subscriptions', 'SubscriptionController')->middleware('auth');

Route::resource('bodies' , 'BodyController')->middleware('auth');

Route::resource('goals' , 'GoalController')->middleware('auth');

Route::resource('stats' , 'StatController')->middleware('auth');

Route::resource('payments' , 'PaymentController')->middleware('auth');

//Route::resource('verified' , 'VerifiedController');

Route::get('verified/{token}' , 'VerifiedController@confirm')->name('verified.confirm')->middleware('activate');
Route::post('verified' , 'VerifiedController@activate')->name('verified.activate')/*->middleware('activate')*/;



Route::get('/hours', 'TrainingController@hoursList')->name('reservations.hoursList')->middleware('auth');
Route::post('/admin-reservation', 'ReservationController@storeModal')->name('reservations.storeModal')->middleware('auth');
Route::get('/search', 'SearchController@search')->name('searches.search')->middleware('auth');
Route::get('/display-trainings', 'TrainingController@displayTrainings')->name('reservations.displayTrainings')->middleware('auth');
Route::post('/back-reservation', 'ReservationController@backReservation')->name('reservations.backReservation')->middleware('auth');




Route::resource('trainings', 'TrainingController')->middleware('auth');
Route::resource('trainings_settings', 'SettingController')->middleware('auth');








