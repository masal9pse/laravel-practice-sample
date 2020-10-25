<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
 use RefreshDatabase;

 public function setUp(): void
 {
  parent::setUp();

  $this->user = factory(User::class)->create();
 }

 public function testUserStore()
 {
  $data = [ # 登録用のデータ   
   'name' => 'TanakaTaro',
   'email' => 'user@example.com',
   'password' => password_hash('password123', PASSWORD_DEFAULT)
  ];

  // POST リクエスト
  $response = $this->post('api/user/', $data);

  // レスポンス検証
  $response->assertStatus(200)
   ->assertJsonFragment([
    'name' => 'TanakaTaro',
    'email' => 'user@example.com',
   ]);
 }

 // いいねテストエラー
 //public function testLikeStore()
 //{
 // $this->withoutExceptionHandling();
 // $data = [ # 登録用のデータ   
 //  'user_id' => 55,
 //  'song_id' => 50,
 // ];

 // // POST リクエスト
 // $response = $this->withExceptionHandling()->postjson('api/posts/50/like', $data);

 // // レスポンス検証
 // $response->assertStatus(200)
 //  ->assertJsonFragment([
 //   'likeCount' => 1
 //  ]);
 //}
}
