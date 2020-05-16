<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginApiTest extends TestCase
{
 use RefreshDatabase;

 public function setUp(): void
 {
  parent::setUp();

  // テストユーザー作成
  $this->user = factory(User::class)->create();
  // dd($this->user);
 }
 /**
  * A basic test example.
  * @test
  * @return void
  */

 public function testLoggedIn()
 {
  $user = factory(User::class)->create();

  $response = $this->actingAs($user)
   ->get('/');

  $response->assertStatus(200);
 }

 // public function should_登録済みのユーザーを認証して返却する()
 // {
 //  $response = $this->json('POST', route('login', [
 //   // 'email' => $this->user->email,
 //   'email' => 'test@test.com',
 //   'password' => 'password123'
 //  ]));

 //  $response
 //   ->assertStatus(200);
 //  // ->assertJson(['name' => $this->user->name]);

 //  $this->assertAuthenticatedAs($this->user);
 // }
}
