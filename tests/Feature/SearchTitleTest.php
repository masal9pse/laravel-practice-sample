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
}
