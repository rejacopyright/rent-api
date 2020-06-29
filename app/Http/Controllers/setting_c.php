<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setting;
use App\settings\brand;

class setting_c extends Controller
{
  function setting(){
    return setting::first();
  }
  function update(Request $r){
    $setting = setting::firstOrNew();
    if ($r->name) {
      $setting->name = $r->name;
    }
    if ($r->image) {
      $setting->image = $r->image;
    }
    if ($r->desc) {
      $setting->desc = $r->desc;
    }
    if ($r->in) {
      $setting->in = $r->in;
    }
    if ($r->out) {
      $setting->out = $r->out;
    }
    $setting->save();
    return $setting;
  }
  function brand(Request $r){
    $page = brand::orderBy('name');
    if ($r->q) { $page->where('name', 'like', '%'.$r->q.'%'); }
    $page = $page->paginate(10);
    $brand = $page->map(function($i){
      return $i;
    });
    return compact('brand', 'page');
  }
  function brand_store(Request $r){
    $message = 'Successfully created new brand';
    $brand = new brand;
    $brand->brand_id = brand::max('brand_id')+1;
    $brand->name = $r->name;
    $exist = brand::where('name', $r->name)->count();
    if (!$exist) {
      $brand->save();
    }else {
      $message = 'the name you entered is exist. Please choose a different name';
    }
    return compact('brand', 'message');
  }
}
