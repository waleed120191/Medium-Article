<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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


Auth::routes();

Route::get('/', 'Front\ArticleController@index');
Route::get('/home', 'Front\ArticleController@index')->name('home');

Route::middleware(['auth'])->group(function () {

    Route::resource('admin/articles', 'Admin\ArticleController');
    Route::resource('admin/tags', 'Admin\TagController');
    Route::post('admin/upload', function (Request $request) {

        $uploadedFile = $request->file('upload');
        $filename = time() . $uploadedFile->getClientOriginalName();

        Storage::disk('local')->putFileAs(
            'public/',
            $uploadedFile,
            $filename
        );

        return response()->json([
            "uploaded" => 1,
            "fileName" => $filename,
            "url" => url('storage/' . $filename)
        ]);
    });

});

Route::resource('articles', 'Front\ArticleController');

