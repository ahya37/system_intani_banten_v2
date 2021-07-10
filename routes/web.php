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

Route::get('/register/management','FrontController@registerManagement')->name('register-management');
Route::post('/register/management/store','FrontController@saveRegisterManagement')->name('register.management.store');

Route::get('success/submission/{code}', 'Member\SurveyTeamController@successAproveSubmission')->name('succes-aprove-submission');

Route::group(['prefix' => 'member','namespace' => 'Member'], function(){
	 		Route::get('login', 'LoginController@login')->name('member-page-login');
			Route::post('login','LoginController@store')->name('member-login');
			 
			//  API after login
			Route::get('farmer/api','ApiController@getFarmerAPI')->name('member-management-farmer-api');
			Route::get('api/management/farmer','ApiController@getFarmerByManager')->name('api-management-farmer');
			Route::get('api/management/typeagricultur/{farmers_id}','ApiController@getTypeAgricultur');

	 		Route::group(['middleware' => 'member'], function(){
	 			Route::get('dashboard', 'HomeController@index')->name('member-dashboard');
				Route::post('logout', 'LoginController@logout')->name('member-logout');

				// profile
	 			Route::get('persoanl/invalid/profesion', 'HomeController@invalidProfesion')->name('member-invalid-profesion');
	 			Route::get('persoanl/profile','ProfileController@index')->name('member-profile');
				Route::get('persoanl/ecard','ProfileController@ecard')->name('member-ecard');
				Route::get('personal/validation/profession','HomeController@cekFormValidationProfession')->name('member-validation-profession');
				Route::post('personal/agriculturgroup/save','AgriculturGroupController@store')->name('member-store-agriculturgroup');
				Route::get('personal/capital','CapitalController@createPersonal')->name('member-persoanl-capital');

				//next management dan investor kelengkapan data diri
				Route::get('/next/management','ManagerController@nextManagement')->name('member-next-management');
				Route::post('/next/management/save','ManagerController@nextStore')->name('member-next-management-save');
				Route::get('/next/investor','InvestorController@nextInvestor')->name('member-next-investor');
				Route::post('/next/investor/save','InvestorController@nextStore')->name('member-next-investor-save');
				Route::get('/next/capital','CapitalController@createPersonal')->name('member-next-capital');
				Route::post('/next/capital/save','CapitalController@nextStore')->name('member-next-capital-save');

				// notulen
				Route::get('persoanl/cek/profession','ProfileController@profession')->name('member-cek-profession');
				Route::get('notulen/index','NotulenController@index')->name('member-notulen');
				Route::get('notulen/create','NotulenController@create')->name('member-notulen-create');
				Route::get('notulen/show/{id}','NotulenController@show')->name('member-notulen-show');
				Route::get('notulen/pdf/{id}','NotulenController@notulenPdf')->name('member-notulen-pdf');
				Route::post('notulen/save','NotulenController@store')->name('member-notulen-save');
				Route::post('notulen/signature/save','NotulenController@saveSignature')->name('member-notulen-signature-save');

				// tim survey
				Route::get('timsurvey','SurveyTeamController@index')->name('member-surveyteam');
				Route::post('timsurvey/submission','SurveyTeamController@saveSubmission')->name('member-surveyteam-submission');
				Route::get('timsurvey/farmer','SurveyTeamController@pageFarmer')->name('member-survey-farmer');
				Route::get('timsurvey/farmer/create','SurveyTeamController@createFarmer')->name('member-farmer-create');
				Route::post('timsurvey/farmer/save','SurveyTeamController@saveAddFarmer')->name('member-farmer-save');
				Route::get('timsurvey/agricultur/create/{member_id}','SurveyTeamController@createAgriculturGroup')->name('member-agricultur-create');
				Route::post('timsurvey/agricultur/save','SurveyTeamController@saveAddAgriculturGroup')->name('member-agricultur-save');
				Route::get('timsurvey/agricultur','SurveyTeamController@pageAgriculturalGroup')->name('member-agricultur');
				Route::get('timsurvey/management/{id}','SurveyTeamController@createManagement')->name('member-management-create');
				Route::post('timsurvey/management/save','SurveyTeamController@saveManagement')->name('member-management-save');
				Route::get('timsurvey/investor/{management_id}/{agricultur_group_id}','SurveyTeamController@createInvestor')->name('member-investor-create');
				Route::post('timsurvey/investor/save','SurveyTeamController@saveInvestor')->name('member-investor-save');
				Route::get('timsurvey/capital','SurveyTeamController@pageCapital')->name('member-capital');
				Route::get('timsurvey/capital/create/{capital_id}','SurveyTeamController@createCapital')->name('member-capital-create');
				Route::post('timsurvey/capital/save','SurveyTeamController@saveCapital')->name('member-capital-save');

			 });

		Route::group(['prefix' => 'management'], function(){
			Route::get('management','ManagementController@index')->name('member-management-index');
			Route::post('upladfamilycard','ManagementController@saveFamilyCard')->name('member-management-uplaodfamilycard');
			Route::get('invstore/create','ManagementController@createInvestor')->name('member-management-investor-create');

			// investor
			Route::post('invstore/save','ManagementController@saveInvestor')->name('member-management-investor-save');
			Route::get('invstore/index','InvestorController@index')->name('member-management-investor-index');
			Route::get('invstore/farmer/{investor_id}','InvestorController@farmerByInvestor')->name('member-management-investor-farmer');
			Route::get('invstore/capitalbreakdown/{agricultur_group_id}','InvestorController@capitalBreakdown')->name('member-management-investor-capitalbreakdown');

			// petani
			Route::get('farmer/index','FarmerController@index')->name('member-management-farmer-index');
			Route::get('farmer/create','ManagementController@createFarmer')->name('member-management-farmer-create');
			Route::post('farmer/save','ManagementController@saveFarmer')->name('member-management-farmer-save');

			// kelompok pertanain
			Route::get('agriculturalgroup/index','AgriculturGroupController@index')->name('member-management-agriculturalgroup-index');
			Route::get('agriculturalgroup/create','ManagementController@createAgriculturGroup')->name('member-management-agriculturalgroup-create');
			Route::post('agriculturalgroup/save','ManagementController@saveAgriculturGroup')->name('member-management-agriculturalgroup-save');
			Route::get('agriculturalgroup/detailfarmer/{type_of_agriculture_id}','AgriculturGroupController@detailFarmerByAgriculturGroupId')->name('member-management-agriculturalgroup-farmerbyagricultur');

			// permodalan
			Route::get('capital/create','ManagementController@createCapital')->name('member-management-capital-create');
			Route::post('capital/save','ManagementController@saveCapital')->name('member-management-capital-save');
			Route::get('capital/index','CapitalController@index')->name('member-management-capital-index');
			Route::get('capital/detail/{investor_id}','CapitalController@detailCapital')->name('member-management-capital-detail');

			// perencanaan panen
			Route::get('invstore/harvestplanning/{agricultur_group_id}','InvestorController@harvestPlanningByAgriculturId')->name('member-management-investor-harvestplanning');
			


		});
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
