<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTitleTest extends TestCase
{
 use RefreshDatabase;
 /**
  * A basic test example.
  *
  * @return void
  */
 public function testExample()
 {
  $response = $this->get('/');

  $response->assertStatus(200);
 }
 // public function test_同じタイトルを入力した時()
 // {
 //  $response = $this->get('/', [
 //   'search' => 'pretender',
 //  ]);

 //  $response->assertStatus(200)
 //   // ->assertViewIs('songs.index')
 //   ->assertSee('pretender');
 // }
}
