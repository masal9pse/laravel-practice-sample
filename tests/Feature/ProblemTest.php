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
 public function test_問題点を１件登録する()
 {
  $response = $this->post('/problems', [
   'name' => 'テストユーザー',
   'problem' => '歌大好き'
  ]);

  $response->assertRedirect('/');
 }

 public function test_問題点を複数登録する()
 {
  $response = $this->post('/problems', [
   'problems' => [
    [
     'name' => 'テストユーザー1',
     'problem' => '歌大好き'
    ],
    [
     'name' => 'テストユーザー2',
     'problem' => '歌大嫌い'
    ],
   ]
  ]);

  $response->assertRedirect('/');
 }

 public function test_問題点を入力しない()
 {
  $response = $this->post('/problems', [
   'name' => 'ユーザー',
   'problem' => ''
  ]);
  // バリデーションメッセージをそのまま記入する
  $response->assertSessionHasErrors([
   'problem' => '感想は必須です。',
  ]);
 }

 public function test_文字数がオーバーする時のバリデーション()
 {
 }
}
