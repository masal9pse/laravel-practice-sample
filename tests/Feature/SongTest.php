<?php

namespace Tests\Feature;

use App\Models\Song;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SongTest extends TestCase
{
 use RefreshDatabase;

 public function testIsLikedByTheUser()
 {
  $song = factory(Song::class)->create();
  $user = factory(User::class)->create();
  $song->likes()->attach($user);

  $result = $song->isLiked($user);

  $this->assertTrue($result);
 }
}
