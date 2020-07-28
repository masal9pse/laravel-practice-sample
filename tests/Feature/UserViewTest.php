<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Admin;

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

 // public function test_詳細画面が正常に表示される()
 // {
 //  $this->withoutExceptionHandling();
 //  $response = $this->get('/songs/1');

 //  $response->assertStatus(200);
 // }
}
