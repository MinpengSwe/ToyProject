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
    'uses' => 'ProductController@Index'
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
Route::group(['middleware' => 'user'], function () {
    Route::get('/register', 'RegistrationController@register');
    Route::post('/register', 'RegistrationController@postRegister');

    Route::get('/login', 'LoginController@login');
    Route::post('/login', 'LoginController@postLogin');
    Route::get('/forgot-password', 'ForgotPasswordController@forgotPassword');
    Route::post('/forgot-password', 'ForgotPasswordController@postForgotPassword');
    Route::get('/reset/{email}/{resetCode}', 'ForgotPasswordController@resetPassword');
    Route::post('/reset/{email}/{resetCode}', 'ForgotPasswordController@postResetPassword');
});


Route::get('/logout', 'LoginController@logout');

//this add admin middleware to earning route
Route::get('/admin', 'AdminController@Index')->middleware('admin');

Route::post('/assignRole', [
    'as' => 'assignRole',
    'uses'=>'AdminController@postAdminAssignRoles',
    'middleware' => 'admin'
]);

Route::get('/tasks', 'ManagerController@tasks')->middleware('manager');

//two paragemeter, email and activationcode
Route::get('/activate/{email}/{activationCode}', 'ActivationController@activate');

//ecommece
/*
Route::get('/shop', function(){
    return view('shop.index');
});
*/


Route::get('/profile', 'UserController@getProfile');

Route::get('/add-to-cart/{id}', [
    'as'=>'product.addToCart',
    'uses'=> 'ProductController@getAddToCart'

]);
//'as' part is used in route function
Route::get('/shopping-cart', [
    'as'=>'product.shoppingCart', //e.g route('product.shoppingCart') => "http://localhost:8000/shopping-cart"
    'uses'=> 'ProductController@getCart',
    //middleware is a filter, in this case, preventing unauthrized user access to a customers shopping cart
    //if the user is not 'auth', 'admin', 'manager', then getCart method in ProductController is not even called
    //'middleware' => 'auth',
    //'middleware' => 'admin',
    //'middleware' => 'manager'
]);

Route::get('/checkout', [
    'as'=>'checkout',
    'uses'=>'ProductController@getCheckout',
 //   'middleware' => 'auth'
]);

Route::post('/checkout', [
    'as'=>'checkout',
    'uses'=>'ProductController@postCheckout',
  //  'middleware' => 'auth'
]);

Route::get('/reduce/{id}', [
    'uses' => 'ProductController@getReduceByOne',
    'as' => 'product.reduceByOne'
]);

Route::get('/remove/{id}', [
    'uses' => 'ProductController@getRemoveItem',
    'as' => 'product.remove'
]);