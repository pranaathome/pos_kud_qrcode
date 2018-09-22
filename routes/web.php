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

Route::get('/', function() {
    return redirect(route('login'));
});
Auth::routes();
Route::group(['middleware' => 'auth'], function() { //mengecek authentication user
    Route::resource('/kategori', 'CategoryController')->except([
        'create', 'show'
    ]);
    Route::resource('/produk', 'ProductController');
    Route::get('/home', 'HomeController@index')->name('home');
    
});
//cara lain cek auth, menambahkan ini disetiap controller
/*public function __construct()
{
    $this->middleware('auth);
}*/
