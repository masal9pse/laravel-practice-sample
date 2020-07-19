<?php

namespace Tests\Feature;

use App\Admin;
use App\Models\Song;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminSongControllerTest extends TestCase
{
 use RefreshDatabase;

 public function setUp(): void
 {
  parent::setUp();

  $this->admin = factory(Admin::class)->create();
  $this->user = factory(User::class)->create();
 }
 /**
  * A basic test example.
  *
  * @return void
  */
 public function test_歌詞を投稿に成功した時()
 {
  $this->withoutExceptionHandling();
  $response = $this->actingAs($this->admin, 'admin')
   ->post(route('admin.store'), [
    // ダミーファイルを作成して送信している
    // 'photo' => UploadedFile::fake()->image('photo.jpg'),
    'title' => '国歌',
    'detail' => 'きみがあよおは',
    'file_name' => ''
   ]);;
  $response->assertStatus(201);
 }
}
