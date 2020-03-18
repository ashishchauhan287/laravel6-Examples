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
    return view('welcome');
});

// Upload Mulitple Document
// http://127.0.0.1:8000/document
Route::get('document', 'DocumentController@index')->name('document');
Route::post('documentstore', 'DocumentController@store')->name('documentstore');

// AJAX CRUD Example
// http://127.0.0.1:8000/my-posts
Route::get('my-posts', 'PostController@myPosts');
Route::resource('posts','PostController');

//fullcalender
// http://127.0.0.1:8000/fullcalendar
Route::get('fullcalendar','FullCalendarController@index');
Route::post('fullcalendar/create','FullCalendarController@create');
Route::post('fullcalendar/update','FullCalendarController@update');
Route::post('fullcalendar/delete','FullCalendarController@destroy');

// Paginsation With Array
// http://127.0.0.1:8000/document
Route::get('paginate', 'PaginationController@index');
    
// Admin Only
// http://127.0.0.1:8000/role
Route::get('/role', 'HomeController@role');
Route::middleware('can:isAdmin')->prefix('admin')->group(function () {
    // Mention all admin routes
    Route::get('/role', 'HomeController@role');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Send email using SendGrid
// http://127.0.0.1:8000/mail
Route::get('/mail', 'HomeController@mail');

// Dompdf for generate pdf files
// http://127.0.0.1:8000/customers/pdf
Route::get('/customers/pdf','CustomerController@export_pdf')->name('customer.pdf');


// Excel import and export
// http://127.0.0.1:8000/importExportView
Route::get('export', 'ExcelController@export')->name('export');
Route::get('importExportView', 'ExcelController@importExportView');
Route::post('import', 'ExcelController@import')->name('import');

// Ajax Search
// http://127.0.0.1:8000/search
Route::get('search','SearchController@index')->name('search');
Route::get('ajaxsearch','SearchController@search')->name('ajaxsearch');

// HighChart
// http://127.0.0.1:8000/chart
Route::get('chart', 'ChartController@index');

// Custom Helper
// http://127.0.0.1:8000/customhelper
Route::get('customhelper','CheckHelperController@index')->name('customhelper');
Route::post('customhelper/store','CheckHelperController@store')->name('customhelper/store');

// Upload image in amazon S3 bucket
// http://127.0.0.1:8000/image
 Route::get('image', 'ImageController@index');
 Route::resource('images', 'ImageController', ['only' => ['store', 'destroy']]);
 //Route::post('store', 'ImageController@store');
 //Route::post('delete', 'ImageController@destroy');


// Add,Update,Delete and Listing Using Ajax 
 // http://127.0.0.1:8000/ajaxtable
Route::get('/ajaxtable', 'AjaxTableController@index');
Route::get('/ajaxtable/fetch_data', 'AjaxTableController@show');
Route::post('/ajaxtable/add_data', 'AjaxTableController@store')->name('ajaxtable.add_data');
Route::post('/ajaxtable/update_data', 'AjaxTableController@update')->name('ajaxtable.update_data');
Route::post('/ajaxtable/delete_data', 'AjaxTableController@destroy')->name('ajaxtable.delete_data');
