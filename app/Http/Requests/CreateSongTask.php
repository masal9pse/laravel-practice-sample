<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Nullable;

class CreateSongTask extends FormRequest
{
 /**
  * Determine if the user is authorized to make this request.
  *
  * @return bool
  */
 public function authorize()
 {
  return true;
 }

 /**
  * Get the validation rules that apply to the request.
  *
  * @return array
  */
 public function rules()
 {
  return [
   'title' => 'required|max:100',
   'detail' => 'required|max:1000',
   'file_name' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048'
  ];
 }

 public function attributes()
 {
  return [
   'title' => 'タイトル',
   'detail' => '歌詞',
  ];
 }

 public function messages()
 {
  return [
   'detail.after_or_equal' => ':attribute には今日以降の日付を入力してください。',
  ];
 }
}
