<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class Test1 extends TestCase
{
 use RefreshDatabase;
 /**
  * A basic test example.
  *
  * @return void
  */
 public function testExample()
 {
  $response = $this->get('/');
  $response->assertSuccessful();
 }

 /**
  * @test
  */
 public function loginTest()
 {
  $response = $this->get('/login')
   ->assertRedirect('/login')
   ->assertStatus(200);
 }

 public function loginUserTest()
 {
  //ユーザの作成・認証
  $user     = factory(User::class)->create();
  $response = $this->actingAs($user);

  //マイページトップ
  $response->get('/mypage')
   ->assertSuccessful();

  //会員用ニュースページ
  $response->get('/mypage/news')
   ->assertSuccessful();
 }
}
