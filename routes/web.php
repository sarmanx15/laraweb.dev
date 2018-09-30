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

Route::get('/', 'GuestController@index');

// Route::get('/about',function(){
// 	return view('about');
// });
Route::get('/about','MyController@showAbout');

Route::get('/testmodel',function(){
	$query = App\Post::all();
	return $query;
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','middleware'=>['auth','role:admin']], function(){
	// Route diisi disini...
	Route::resource('authors','AuthorsController');
	Route::resource('books', 'BooksController');
});

Route::get('books/{book}/borrow',[
	'middleware'	=> ['auth','role:member'],
	'as'			=> 'guest.books.borrow',
	'uses'			=> 'BooksController@borrow'
]);