<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
 /**
  * Bootstrap any application services.
  *
  * @return void
  */
 public function boot()
 {
  if (request()->isSecure()) {
   \URL::forceScheme('https');
  }
 }

 /**
  * Register any application services.
  *
  * @return void
  */
 public function register()
 {
  $this->app->bind('App\Services\SongService');
 }
}
