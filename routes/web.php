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
Auth::routes(['register'=> false, 'reset'=>false]);

Route::get('/', 'BlogController@index');
/*Route::get('/isi_post', function(){
	return view('blog.isi_post');
});*/
Route::get('/isi-post/{slug}', 'BlogController@isi_blog')->name('blog.isi');
Route::get('/list-post','BlogController@list_blog')->name('blog.list');
Route::get('/list-category/{category}','BlogController@list_category')->name('blog.category');


Route::get('/list-tag/{tags}','BlogController@list_tag')->name('blog.tag');


Route::get('/cari','BlogController@cari')->name('blog.cari');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('/category','CategoryController');
    Route::get('/tabel/category', 'CategoryController@dataTable')->name('tabel.kategori');
    Route::get('/category/delete/{id}', 'CategoryController@destroy');


    Route::resource('/tag','TagController');
    Route::get('/tabel/tag', 'TagController@dataTable')->name('tabel.tag');
    Route::get('/tag/delete/{id}', 'TagController@destroy');


    Route::resource('/leader','leadersController');
    Route::get('/tabel/leaders', 'leadersController@dataTable')->name('tabel.leaders');
    Route::get('/leaders/delete/{id}', 'leadersController@destroy');

    Route::resource('/user','UserController');
    Route::get('/tabel/user', 'UserController@dataTable')->name('tabel.user');
    Route::get('/user/delete/{id}', 'UserController@destroy');

    //post route
    Route::get('/post/tampil_hapus','PostController@tampil_hapus')->name('post.tampil_hapus');
    Route::get('/post/restore{id}','PostController@restore')->name('post.restore');
    Route::delete('/post/kill{id}','PostController@kill')->name('post.kill');
    Route::resource('/post','PostController');

});













