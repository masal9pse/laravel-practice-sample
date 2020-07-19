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
 }


 public function test_画像とタグが未入力で歌詞を投稿に成功した時()
 {
  $this->withoutExceptionHandling();
  $response = $this->actingAs($this->admin, 'admin')
   ->post(route('admin.store'), [
    'title' => '国歌',
    'detail' => 'きみがあよおは',
    'file_name' => ''
   ]);;

  $response->assertRedirect('/admin/create');
 }
}
