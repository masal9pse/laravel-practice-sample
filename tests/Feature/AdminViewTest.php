<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Admin;

class AdminViewTest extends TestCase
{
 use RefreshDatabase;
 /**
  * A basic test example.
  *
  * @return void
  */
 public function test_管理認証画面が正常に表示される()
 {
  $response = $this->get('/admin/login');

  $response->assertStatus(200);
 }

 public function test_管理画面トップが正常に表示される()
 {
  $this->withoutExceptionHandling();
  $this->admin = factory(Admin::class)->create();
  $response = $this->actingAs($this->admin, 'admin');
  $response = $this->get('/admin/create');

  $response->assertStatus(200);
 }
}
