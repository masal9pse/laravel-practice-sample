<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Song;
use App\Problem;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SongControllerTest extends TestCase
{
 use RefreshDatabase;

 public function testIndex()
 {
  $response = $this->get(route('songs.index'));

  $response->assertStatus(200)
   ->assertViewIs('songs.index');
 }

 public function testGuestCreate()
 {
  $response = $this->get(url('songs/{song}'));

  $response->assertRedirect(route('login'));
 }

 // AAAを意識
 public function testAuthCreate()
 {
  $user = factory(User::class)->create();

  $response = $this->actingAs($user)
   ->get(route('songs.index'));

  $response->assertStatus(200)
   ->assertViewIs('songs.index');
 }
}
