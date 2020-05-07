<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends DuskTestCase
{
 use RefreshDatabase;
 /**
  * A Dusk test example.
  *@test
  * @return void
  */
 public function testExample(User $user)
 {
  // $user = DB::table('users')->truncate(); // データ全削除
  $this->browse(function ($browser) {
   $browser->visit('section/login')
    ->type('section_auth_id', 'aaaaa')
    ->type('username', 'a1234567')
    ->type('password', 'a1234567')
    ->press('login_button')
    ->assertPathIs('/section');
  });
 }
}
