<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group([

    'middleware' => 'api',
    'namespace' => '\App\Http\Controllers',

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    // Route::post('create-user', 'AuthController@createUser');
    
    Route::group(['middleware' => 'jwt.auth'], function(){
        // Route::group(['middleware' => 'permit'], function(){

            // Integration
            Route::post('tender', 'IntegrationController@tender');
            Route::get('tender/regions', 'IntegrationController@getTenderRegions');
            Route::post('tenderByRegion', 'IntegrationController@tenderByRegion');
            //Dashboard
            Route::get('dashboard', 'DashboardController@index');

            //User model
            Route::get('profile', 'UserController@profile');
            Route::post('change-password', 'UserController@changePasword');

            //Country CRUD
            Route::post('country', 'CountryController@index');
            Route::get('country/list', 'CountryController@list');
            Route::get('country/edit/{id}', 'CountryController@edit');
            Route::post('country/update/{id}', 'CountryController@update');
            Route::post('country/store', 'CountryController@store');
            Route::delete('country/destroy/{id}', 'CountryController@destroy');

            //Code Group CRUD
            Route::post('codegroup', 'CodeGroupController@index');
            Route::get('codegroup/edit/{id}', 'CodeGroupController@edit');
            Route::post('codegroup/update/{id}', 'CodeGroupController@update');
            Route::post('codegroup/store', 'CodeGroupController@store');
            Route::delete('codegroup/destroy/{id}', 'CodeGroupController@destroy');

            //ImpExpTamoj CRUD
            Route::post('impexp/excel-upload', 'ImpExpTamojController@excel');
            Route::post('impexp', 'ImpExpTamojController@index');
            Route::post('impexp/upload', 'ImpExpTamojController@upload');
            Route::get('impexp/edit/{id}', 'ImpExpTamojController@edit');
            Route::post('impexp/update/{id}', 'ImpExpTamojController@update');
            Route::post('impexp/store', 'ImpExpTamojController@store');
            Route::delete('impexp/destroy/{id}', 'ImpExpTamojController@destroy');

            //Reports
            Route::post('report/first', 'ReportController@first');
            Route::get('report/second', 'ReportController@second');

            //Employee CRUD
            Route::post('employee', 'EmployeeController@index');
            Route::post('checkemail', 'EmployeeController@checkemail');
            Route::post('employee/store', 'EmployeeController@store');
            Route::get('employee/list', 'EmployeeController@list');
            Route::get('employee/edit/{id}', 'EmployeeController@edit');
            Route::post('employee/update/{id}', 'EmployeeController@update');
            Route::delete('employee/destroy/{id}', 'EmployeeController@destroy');

            //Position Model
            Route::get('position/all','PositionController@index');
            Route::get('position/list','PositionController@list');
            Route::post('position/store','PositionController@store');
            Route::get('position/edit/{id}','PositionController@edit');
            Route::post('position/update/{id}','PositionController@update');
            Route::delete('position/destroy/{id}','PositionController@destroy');

            //Region CRUD
            Route::post('region', 'RegionController@index');
            Route::get('region/list', 'RegionController@list');
            Route::post('region/store', 'RegionController@store');
            Route::get('region/edit/{id}', 'RegionController@edit');
            Route::post('region/update/{id}', 'RegionController@update');
            Route::delete('region/destroy/{id}', 'RegionController@destroy');

            //Airportinfo CRUD
            Route::post('airportinfo', 'AirportinfoController@index');
            Route::get('airportinfo/list', 'AirportinfoController@list');
            Route::post('airportinfo/store', 'AirportinfoController@store');
            Route::get('airportinfo/edit/{id}', 'AirportinfoController@edit');
            Route::post('airportinfo/update/{id}', 'AirportinfoController@update');
            Route::delete('airportinfo/destroy/{id}', 'AirportinfoController@destroy');
            Route::delete('airportinfo/destroy-plane-type/{id}', 'AirportinfoController@destroyPlaneType');
            Route::delete('airportinfo/destroy-avia-city/{id}', 'AirportinfoController@destroyAviaCity');
            Route::delete('airportinfo/destroy-airport-code/{id}', 'AirportinfoController@destroyAirportCode');
            Route::delete('airportinfo/destroy-airport-way/{id}', 'AirportinfoController@destroyAirportWay');
            Route::delete('airportinfo/destroy-airport-recon/{id}', 'AirportinfoController@destroyAirportRecon');

            //Busmodel CRUD
            Route::post('busmodel', 'BusmodelController@index');
            Route::get('busmodel/list', 'BusmodelController@list');
            Route::post('busmodel/store', 'BusmodelController@store');
            Route::get('busmodel/edit/{id}', 'BusmodelController@edit');
            Route::post('busmodel/update/{id}', 'BusmodelController@update');
            Route::delete('busmodel/destroy/{id}', 'BusmodelController@destroy');

            //StatisticAvtoMainIndicator CRUD
            Route::post('statistic/main', 'StatisticAvtoMainIndicatorController@main');
            Route::post('statistic', 'StatisticAvtoMainIndicatorController@index');
            Route::get('statistic/list', 'StatisticAvtoMainIndicatorController@list');
            Route::post('statistic/store', 'StatisticAvtoMainIndicatorController@store');
            Route::get('statistic/edit/{id}', 'StatisticAvtoMainIndicatorController@edit');
            Route::post('statistic/update/{id}', 'StatisticAvtoMainIndicatorController@update');
            Route::delete('statistic/destroy/{id}', 'StatisticAvtoMainIndicatorController@destroy');

            //StatisticInternational CRUD
            Route::post('statisticinternationalcargo/main', 'StatisticInternationalCargoController@main');
            // Route::post('statisticinternationalcargo', 'StatisticInternationalCargoController@index');
            Route::get('statisticinternationalcargo/list', 'StatisticInternationalCargoController@list');
            Route::post('statisticinternationalcargo/store', 'StatisticInternationalCargoController@store');
            Route::get('statisticinternationalcargo/edit/{id}', 'StatisticInternationalCargoController@edit');
            Route::post('statisticinternationalcargo/update/{id}', 'StatisticInternationalCargoController@update');
            Route::delete('statisticinternationalcargo/destroy/{id}', 'StatisticInternationalCargoController@destroy');

            //StatisticInternational CRUD
            Route::post('statisticinternationalmoney/main', 'StatisticInternationalMoneyController@main');
            // Route::post('statisticinternationalmoney', 'StatisticInternationalmoneyController@index');
            Route::get('statisticinternationalmoney/list', 'StatisticInternationalMoneyController@list');
            Route::post('statisticinternationalmoney/store', 'StatisticInternationalMoneyController@store');
            Route::get('statisticinternationalmoney/edit/{id}', 'StatisticInternationalMoneyController@edit');
            Route::post('statisticinternationalmoney/update/{id}', 'StatisticInternationalMoneyController@update');
            Route::delete('statisticinternationalmoney/destroy/{id}', 'StatisticInternationalMoneyController@destroy');

            //Area CRUD
            Route::post('area', 'AreaController@index');
            Route::post('area/store', 'AreaController@store');
            Route::get('area/list', 'AreaController@list');
            Route::get('area/edit/{id}', 'AreaController@edit');
            Route::post('area/update/{id}', 'AreaController@update');
            Route::post('area/regionby', 'AreaController@regionby');
            Route::delete('area/destroy/{id}', 'AreaController@destroy');

            //RegionPlan CRUD
            Route::post('regionplan', 'RegionPlanController@index');
            Route::post('regionplan/store', 'RegionPlanController@store');
            Route::get('regionplan/list', 'RegionPlanController@list');
            Route::get('regionplan/edit/{id}', 'RegionPlanController@edit');
            Route::post('regionplan/update/{id}', 'RegionPlanController@update');
            Route::delete('regionplan/destroy/{id}', 'RegionPlanController@destroy');

            //Expectation CRUD
            Route::post('expectation', 'ExpectationController@index');
            Route::post('expectation/store', 'ExpectationController@store');
            Route::get('expectation/list', 'ExpectationController@list');
            Route::get('expectation/edit/{id}', 'ExpectationController@edit');
            Route::post('expectation/update/{id}', 'ExpectationController@update');
            Route::delete('expectation/destroyAll/{id}', 'ExpectationController@destroyAll');
            Route::delete('expectation/destroy/{id}', 'ExpectationController@destroy');

            //Fakt CRUD
            Route::post('fakt', 'FaktController@index');
            Route::post('fakt/store', 'FaktController@store');
            Route::get('fakt/list', 'FaktController@list');
            Route::get('fakt/edit/{id}', 'FaktController@edit');
            Route::post('fakt/update/{id}', 'FaktController@update');
            Route::delete('fakt/destroy/{id}', 'FaktController@destroy');
            Route::post('fakt/accept', 'FaktController@accept');
            Route::post('fakt/reject', 'FaktController@reject');

            //Station CRUD
            Route::post('station', 'StationController@index');
            Route::post('station/store', 'StationController@store');
            Route::get('station/list', 'StationController@list');
            Route::post('station/regionby', 'StationController@regionby');
            Route::post('station/areaby', 'StationController@areaby');
            Route::get('station/edit/{id}', 'StationController@edit');
            Route::post('station/update/{id}', 'StationController@update');
            Route::delete('station/destroy/{id}', 'StationController@destroy');

            //Offerbuilding model
            Route::post('offerbuilding', 'OfferbuildingController@index');
            Route::post('offerbuilding/store', 'OfferbuildingController@store');
            Route::get('offerbuilding/list', 'OfferbuildingController@list');
            Route::get('offerbuilding/edit/{id}', 'OfferbuildingController@edit');
            Route::post('offerbuilding/update/{id}', 'OfferbuildingController@update');
            Route::delete('offerbuilding/destroy/{id}', 'OfferbuildingController@destroy');
            Route::post('offerbuilding/accept', 'OfferbuildingController@accept');
            Route::post('offerbuilding/reject', 'OfferbuildingController@reject');
            
            //Reconstruction CRUD
            Route::post('reconstruction', 'ReconstructionController@index');
            Route::post('reconstruction/find', 'ReconstructionController@find');
            Route::post('reconstruction/store', 'ReconstructionController@store');
            Route::get('reconstruction/list', 'ReconstructionController@list');
            Route::get('reconstruction/edit/{id}', 'ReconstructionController@edit');
            Route::post('reconstruction/update/{id}', 'ReconstructionController@update');
            Route::delete('reconstruction/destroy/{id}', 'ReconstructionController@destroy');
            Route::post('reconstruction/accept', 'ReconstructionController@accept');
            Route::post('reconstruction/reject', 'ReconstructionController@reject');
            Route::delete('reconstruction/destroy-gallery/{id}', 'ReconstructionController@removeGallery');

            //Role model
            Route::get('role', 'RoleController@index');
            Route::post('role/store', 'RoleController@store');
            Route::get('role/list', 'RoleController@list');
            Route::get('role/edit/{id}', 'RoleController@edit');
            Route::post('role/update/{id}', 'RoleController@update');
            Route::delete('role/destroy/{id}', 'RoleController@destroy');

            // Controllers
            Route::get('controller', 'ContsController@index');
            Route::post('controller/find', 'ContsController@find');
            Route::post('controller/store', 'ContsController@store');
            Route::post('controller/update/{id}', 'ContsController@update')->where('id', '[0-9]+');
            Route::get('controller/edit/{id}', 'ContsController@edit')->where('id', '[0-9]+');
            Route::get('all-controller-actions', 'ContsController@allContActions');

            // Actions
            Route::get('action', 'ActionController@index');
            Route::post('action/store', 'ActionController@store');
            Route::post('action/update/{id}', 'ActionController@update')->where('id', '[0-9]+');
            Route::get('action/edit/{id}', 'ActionController@edit')->where('id', '[0-9]+');

            //Permissions
            Route::post('permissions', 'PermissionController@index');
            Route::post('permissions/store/{id}', 'PermissionController@store')->where('id', '[0-9]+');
        // });
    });


});

