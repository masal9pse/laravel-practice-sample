<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Answer;
use App\Models\User;

class Favorite extends Model
{
 // 配列内の要素を書き込み可能にする
 protected $fillable = ['answer_id', 'user_id'];

 public function answer()
 {
  $this->belongsTo(Answer::class);
 }

 public function user()
 {
  $this->belongsTo(User::class);
 }
}
