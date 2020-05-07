<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopPageTest extends DuskTestCase
{
 use RefreshDatabase;
 /**
  * A basic browser test example.
  *
  * @return void
  */
 public function testTopPage()
 {
  $this->browse(function (Browser $browser) {
   $browser->visit('/')
    ->assertSee('Laravel');
  });
 }
}
