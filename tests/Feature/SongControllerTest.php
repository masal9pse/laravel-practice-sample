<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Song;
use App\Problem;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SongControllerTest extends TestCase
{
 use RefreshDatabase;

 public function testIndex()
 {
  $response = $this->get(route('songs.index'));

  $response->assertStatus(200)
   ->assertViewIs('songs.index');
 }

 public function testGuestCreate()
 {
  $response = $this->get(url('songs/{song}'));

  $response->assertRedirect(route('login'));
 }

 // AAAを意識
 public function testAuthCreate()
 {
  $user = factory(User::class)->create();

  $response = $this->actingAs($user)
   ->get(route('songs.index'));

  $response->assertStatus(200)
   ->assertViewIs('songs.index');
 }

 public function test_store(Problem $problem)
 {
  //第二引数にPOST値の配列を渡すだけ
  // error原因はsongsテーブルを参照しちゃってる
  $response = $problem->post('/problems', [
   'name' => 'テストユーザー',
   'problem' => '歌大好き'
  ]);

  //登録処理が完了して、一覧画面にリダイレクトすることを検証
  $response->assertRedirect();
  // $response->assertRedirect()->route('songs.index');
 }
}
