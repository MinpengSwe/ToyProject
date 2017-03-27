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

Route::get('/', [
    'as' => '/',
    'uses' => 'PagesController@getIndex'
]);

Route::get('about', [
    'as' => 'about',
    'uses' => 'PagesController@getAbout'
]);

Route::get('contact', [
    'as' => 'contact',
    'uses' => 'PagesController@getContact'
]);

Route::get('help', function () {
    return view('pages/help');
});

Route::resource('product', 'ProductController');

//check the kernel.php, and it defines the middleware
Route::group(['middleware' => 'visitors'], function () {
    Route::get('/register', 'RegistrationController@register');
    Route::post('/register', 'RegistrationController@postRegister');

    Route::get('/login', 'LoginController@login');
    Route::post('/login', 'LoginController@postLogin');
    Route::get('/forgot-password', 'ForgotPasswordController@forgotPassword');
    Route::post('/forgot-password', 'ForgotPasswordController@postForgotPassword');
    Route::get('/reset/{email}/{resetCode}', 'ForgotPasswordController@resetPassword');
    Route::post('/reset/{email}/{resetCode}', 'ForgotPasswordController@postResetPassword');
});


Route::post('/logout', 'LoginController@logout');

//this add admin middleware to earning route
Route::get('/earnings', 'AdminController@earnings')->middleware('admin');

Route::get('/tasks', 'ManagerController@tasks')->middleware('manager');

//two paragemeter, email and activationcode
Route::get('/activate/{email}/{activationCode}', 'ActivationController@activate');

//ecommece
Route::get('/shop', function(){
    return view('shop.index');
});

Route::get('/profile', function(){
   return view('user.profile');
});

Route::get('/add-to-cart/{id}', [
    'as'=>'product.addToCart',
    'uses'=> 'ProductController@getAddToCart'

]);
//'as' part is used in route function
Route::get('/shopping-cart', [
    'as'=>'product.shoppingCart',
    'uses'=> 'ProductController@getCart'

]);

Route::get('/checkout', [
    'as'=>'checkout',
    'uses'=>'ProductController@getCheckout',
//    'middleware' => 'auth'
]);

Route::post('/checkout', [
    'as'=>'checkout',
    'uses'=>'ProductController@postCheckout',
  //  'middleware' => 'auth'
]);