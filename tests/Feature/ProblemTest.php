<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Problem;

class ProblemTest extends TestCase
{
 use RefreshDatabase;
 /**
  * A basic test example.
  *
  * @return void
  */
 public function test_store()
 {
  //第二引数にPOST値の配列を渡すだけ
  // error原因はsongsテーブルを参照しちゃってる
  $response = $this->post('/problems', [
   'name' => 'テストユーザー',
   'problem' => '歌大好き'
  ]);

  //登録処理が完了して、一覧画面にリダイレクトすることを検証
  $response->assertRedirect('/');
  // $response->assertRedirect()->route('songs.index');
 }
}
