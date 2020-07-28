<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Song;

class UserViewTest extends TestCase
{
 use RefreshDatabase;
 /**
  * A basic test example.
  *
  * @return void
  */
 public function test_topPageが正常に表示される()
 {
  $response = $this->get('/');

  $response->assertStatus(200);
 }

 public function test_詳細画面の歌詞内容が正常に表示される()
 {
  $song = factory(Song::class)->create();
  $this->assertEquals('苦いようで甘いような〜', $song->detail);
 }
}
