<?php

namespace Tests\Feature;

use App\Admin;
use App\Models\Song;
use Tests\TestCase;
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
    'title' => '今夜このまま',
    'detail' => '苦いようで甘いような〜',
    'file_name' => ''
   ]);;

  $response->assertRedirect('/admin/create');
 }

 public function test_入力必須項目が未入力で歌詞を投稿すると失敗する()
 {
  $response = $this->actingAs($this->admin, 'admin')
   ->post(route('admin.store'), [
    'title' => '',
    'detail' => '',
    'file_name' => ''
   ]);;

  $response->assertSessionHasErrors([
   'title' => 'タイトルは必須です。',
   'detail' => '歌詞は必須です。'
  ]);
 }

 public function test_タイトルが未入力で歌詞を投稿すると失敗する()
 {
  $response = $this->actingAs($this->admin, 'admin')
   ->post(route('admin.store'), [
    'title' => '',
    'detail' => '苦いようで甘いような〜',
    'file_name' => ''
   ]);

  $response->assertSessionHasErrors([
   'title' => 'タイトルは必須です。'
  ]);
 }

 public function test_歌詞を更新したとき()
 {
  $song = Song::create([
   'title' => 'pretender',
   'detail' => '君とのラブストーリー〜',
   'file_name' => false
  ]);

  $this->assertEquals('pretender', $song->title);
  $this->assertEquals('君とのラブストーリー〜', $song->detail);
  $this->assertFalse($song->file_name);

  $song->fill(['title' => 'I Love', 'detail' => '僕が見つける、景色のその中に〜']);
  $song->save();

  $song_update = Song::find($song->id);
  $this->assertEquals('I Love', $song_update->title);
  $this->assertEquals('僕が見つける、景色のその中に〜', $song_update->detail);
 }
}
