<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Validation\Validator;
use Validator;

class AjaxUploadController extends Controller
{
 function index()
 {
  return view('ajax_upload');
 }

 function action(Request $request)
 {
  // サーバー側で処理するにはname属性が必要
  $validator = Validator::make($request->all(), [
   'select_file' => 'required|image|mines:jpeg,png,jpg,gif|max:2048'
  ]);

  if ($validator->passes()) {
   $image = $request->file('select_file');
   $new_name = rand() . '.' . $image->getClientOriginalExtension();
   $image->move(public_path('images'), $new_name);
   return response()->json([
    'message' => 'Image Upload SuccessFully',
    'upload_image' => '<img src="/image' . $new_name . '" class="img-thumbnail" width="300">',
    'class_name' => 'alert_success'
   ]);
  } else {
   return response()->json([
    'message' => $validator->errors()->all(),
    'upload_image' => '',
    'class_name' => 'alert-danger'
   ]);
  }
 }
}
