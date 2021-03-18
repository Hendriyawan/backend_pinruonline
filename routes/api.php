<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'AuthController@login');
Route::post('admin/add_admin', 'AdminController@createAdmin');
Route::post('admin/add_user', 'AdminController@addUser')->middleware('jwt.verify');
Route::post('admin/add_validator', 'AdminController@createValidator')->middleware('jwt.verify');
Route::get('admin/load_user', 'AdminController@loadUser')->middleware('jwt.verify');
Route::post('admin/delete_user/{id}', 'AdminController@deleteUser')->middleware('jwt.verify');
Route::post('surat/create_surat', 'SuratController@createForm')->middleware('jwt.verify');
Route::get('surat/load_surat', 'SuratController@loadSurat')->middleware('jwt.verify');
Route::post('surat/validate/{id}', 'SuratController@validateSurat')->middleware('jwt.verify');
Route::post('surat/approve_surat/{id}', 'SuratController@approveSurat')->middleware('jwt.verify');
Route::post('surat/reject_surat/{id}', 'SuratController@rejectSurat')->middleware('jwt.verify');
Route::get('surat/show_surat/{id}', 'SuratController@showSurat')->middleware('jwt.verify');
Route::post('surat/upload_file', 'SuratController@uploadFile')->middleware('jwt.verify');
Route::post('surat/delete_surat/{id}', 'SuratController@deleteSurat')->middleware('jwt.verify');
Route::post('surat/update_surat/{id}', 'SuratController@updateSurat');
Route::get('fasilitas/load_fasilitas', 'FasilitasController@loadFasilitas');
Route::post('fasilitas/add_fasilitas', 'FasilitasController@createFasilitas')->middleware('jwt.verify');
Route::post('fasilitas/delete_fasilitas/{id}', 'FasilitasController@deleteFasilitas')->middleware('jwt.verify');
Route::post('fasilitas/edit_fasilitas/{id}', 'FasilitasController@editFasilitas')->middleware('jwt.verify');
Route::post('fasilitas/upload_image', 'FasilitasController@uploadImage')->middleware('jwt.verify');
