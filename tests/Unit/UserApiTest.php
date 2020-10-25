<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
 use RefreshDatabase;

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
 public function testLikeStore()
 {
  $data = [ # 登録用のデータ   
   'user_id' => 55,
   'song_id' => 49,
  ];

  // POST リクエスト
  $response = $this->withExceptionHandling()->post('api/posts/49/like', $data);

  // レスポンス検証
  $response->assertStatus(200)
   ->assertJsonFragment([
    'likeCount' => 1
   ]);
 }
}
