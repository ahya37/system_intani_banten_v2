<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'FrontController@home')->name('/');

Route::get('/register/member','FrontController@registerMember')->name('register-member');
Route::post('/typeagricultur/add','FrontController@addTypeAgricultur')->name('add.agricultur');
Route::post('/register/member/store','FrontController@processRegisterMember')->name('register.member.store');
Route::get('verify/{token}', 'FrontController@verifyMemberRegistration')->name('member.verify');

Route::group(['prefix' => 'member','namespace' => 'Member'], function(){
	 		Route::get('login', 'LoginController@login')->name('member-page-login');
	 		Route::post('login','LoginController@store')->name('member-login');

	 		Route::group(['middleware' => 'member'], function(){
	 			Route::get('dashboard', 'HomeController@index')->name('member-dashboard');
				Route::post('logout', 'LoginController@logout')->name('member-logout');
	 			Route::get('persoanl/invalid/profesion', 'HomeController@invalidProfesion')->name('member-invalid-profesion');
	 			Route::get('persoanl/profile','ProfileController@index')->name('member-profile');
				Route::get('persoanl/ecard','ProfileController@ecard')->name('member-ecard');
				Route::get('personal/validation/profession','HomeController@cekFormValidationProfession')->name('member-validation-profession');
				Route::post('personal/agriculturgroup/save','AgriculturGroupController@store')->name('member-store-agriculturgroup');
				Route::get('personal/capital','CapitalController@createPersonal')->name('member-persoanl-capital');

				Route::get('/next/management','ManagerController@nextManagement')->name('member-next-management');
				Route::post('/next/management/save','ManagerController@nextStore')->name('member-next-management-save');
				Route::get('/next/investor','InvestorController@nextInvestor')->name('member-next-investor');
				Route::post('/next/investor/save','InvestorController@nextStore')->name('member-next-investor-save');
				Route::get('/next/capital','CapitalController@createPersonal')->name('member-next-capital');
				Route::post('/next/capital/save','CapitalController@nextStore')->name('member-next-capital-save');

				Route::get('persoanl/cek/profession','ProfileController@profession')->name('member-cek-profession');
				Route::get('notulen/index','NotulenController@index')->name('member-notulen');
				Route::get('notulen/create','NotulenController@create')->name('member-notulen-create');
				Route::get('notulen/show/{id}','NotulenController@show')->name('member-notulen-show');
				Route::get('notulen/pdf/{id}','NotulenController@notulenPdf')->name('member-notulen-pdf');
				Route::post('notulen/save','NotulenController@store')->name('member-notulen-save');
				Route::post('notulen/signature/save','NotulenController@saveSignature')->name('member-notulen-signature-save');



	 		});	
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
