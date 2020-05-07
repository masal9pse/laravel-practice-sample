<?php

namespace Tests\Feature;

use App\Admin;
use App\Models\Song;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class SongTest extends TestCase
{
 use RefreshDatabase;
 /**
  * A basic test example.
  * @test
  * @return void
  */
 public function testSong()
 {
  $response = $this->get('/');

  $response->assertStatus(200);
 }

 public function testBasicExample()
 {
  $data = [
   'name' => 'testUser',
   'email' => 'dummy@email.com',
   'password' => 'test1234',
   'password_confirmation' => 'test1234'
  ];
  $response = $this->withHeaders([
   'X-Header' => 'Value',
  ])->json('POST', route('register'), $data);

  $response
   ->assertStatus(302);
  // ->assertJson([
  //  'created' => true,
  // ]);
 }
 /**
  * @test
  */
 public function 管理画面の詳細機能で適切な表示がされているかどうか()
 {
  $admin = factory(Admin::class)->create();

  $response = $this->actingAs($admin)
   ->get('/admin/show/{id}');

  $response->assertStatus(302);
 }
 /**
  * @test
  */
 // public function 管理画面の詳細機能で適切な表示がされているかどうか()
 // {
 //  // $this->withoutExceptionHandling();
 //  $song = new Song;
 //  $song = Song::find($song->id);

 //  // $song = factory(Song::class)->create();
 //  $this->get(route('admin.show', ['id' => $song->id]))
 //   ->assertStatus(200)
 //   ->assertSee($song->detail)
 //   ->assertSee('歌詞共有サイト管理画面');
 // }
 /**
  * @test
  */
 // public function 管理画面の詳細機能で適切な表示がされているかどうか()
 // {
 //  $this->withoutExceptionHandling();

 //  $admin = factory(Admin::class)->create();
 //  $song = factory(Song::class)->create();
 //  // $product = factory(Product::class)->create();
 //  $admin->actingAs($admin);
 //  $this->get(route('admin.show', ['id' => $song->id]))
 //   // ->actingAs($admin)
 //   ->assertStatus(200)
 //   ->assertSee($song->detail)
 //   ->assertSee('歌詞共有サイト管理画面');
 // }
}
