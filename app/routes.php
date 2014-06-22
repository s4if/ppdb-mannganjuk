<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
// Halaman beranda
Route::get('/', 'HomeController@showDashboard');
// Halaman pengaturan
Route::get('pengaturan', 'HomeController@showSettings');
Route::post('pengaturan', 'HomeController@storeSettings');
// Tampilkan daftar Calon PDB
Route::get('peserta', 'StudentController@showAll');
// Tampilkan daftar Calon PDB sesuai program kelas
Route::get('peserta/program/{program}', 'StudentController@showProgram');
// Tambahkan Calon PDB
Route::get('peserta/baru', 'StudentController@addNew');
Route::post('peserta/baru', 'StudentController@storeNew');
// Lihat detail Calon PDB
Route::get('peserta/detail/{id}', 'StudentController@showDetail');
// Sunting data Calon PDB
Route::get('peserta/sunting/{id}', 'StudentController@showEdit');
Route::post('peserta/sunting', 'StudentController@storeEdit');
// Hapus data Calon PDB
Route::get('peserta/hapus/{id}', 'StudentController@deleteStudent');
// Ekspor data Calon PDB ke MS Excel
Route::get('peserta/ekspor', 'StudentController@exportExcel');
// Ekspor data Calon PDB sesuai program kelas ke MS Excel
Route::get('peserta/ekspor/program/{program}', 'StudentController@exportProgramExcel');