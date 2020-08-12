<?php

namespace Tests\Feature;

use App\Comment;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class CommentTest extends TestCase
{
 use RefreshDatabase;
 // ひとまずルーティングのテストのみ書く
 // 動作テストは後回し
 public function setUp(): void
 {
  parent::setUp();

  $this->user = factory(User::class)->create();
 }
 /**
  * A basic test example.
  * @test
  * @return void
  */
 public function rule_コメントを投稿画面を表示()
 {
  $response = $this
   ->actingAs(User::find(1)) // 追加
   ->get(route('comments.create'));
  // ->get('comments/create');
  // ->get('comments/create?song_id=1');

  $response->assertStatus(200)
   ->assertViewIs('comments.create')
   ->assertSee('投稿する');
 }

 /**
  * 
  */
 public function rules_コメントを正常に投稿する()
 {
 }

 /**
  * 
  */
 public function rules_コメントを正常に削除する()
 {
 }
}
