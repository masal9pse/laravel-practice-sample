<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\HomeController;
use App\Models\Song;

class TaskTest extends TestCase
{
 use RefreshDatabase;

 public function setUp()
 {
  parent::setUp();

  // テストケース実行前にフォルダデータを作成する
  $this->seed('SongsTableSeeder');
 }

 /**
  * A basic test example.
  *
  * @return void
  */
 public function testSongNewCreate()
 {
  $response = $this->post('/admin/store', [
   'title' => 'Sample task',
   'detail' => 111, // 不正なデータ（数値）
  ]);

  $response->assertStatus(302);
  // $response->assertSessionHasErrors([
  //  'detail' => '期限日 には日付を入力してください。',
  // ]);
 }
}
