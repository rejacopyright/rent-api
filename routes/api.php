<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('admin/login', 'admin\auth_c@login');

Route::group(['middleware' => 'auth:admin-api'], function(){
  // Setting
  Route::get('setting', 'setting_c@setting');
  Route::post('setting/update', 'setting_c@update');
  // BRAND
  Route::get('settings/brand', 'setting_c@brand');
  Route::post('settings/brand/store', 'setting_c@brand_store');
  Route::post('settings/brand/update', 'setting_c@brand_update');
  Route::post('settings/brand/delete', 'setting_c@brand_delete');
});
