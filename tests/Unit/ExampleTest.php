<?php

namespace Tests\Unit;

use Illuminate\Database\Seeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
 use RefreshDatabase;
 /**
  * A basic test example.
  * @return void
  */
 public function testBasicTest()
 {
  // ルートの/にアクセス
  $response = $this->get('/');

  // HTTPステータスコードを見ている。
  $response->assertStatus(200);
  // $response->assertStatus(302);
 }
}
