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
  // マイグレーション時に以下のエラーが発生するため、stringのサイズは191文字をデフォルトとする。
  // SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
  // 参考）https://teratail.com/questions/63441
  Schema::defaultStringLength(191);
 }

 /**
  * Register any application services.
  *
  * @return void
  */
 public function register()
 {
  if ($this->app->environment('local', 'testing', 'staging')) {
   $this->app->register(DuskServiceProvider::class);
  }
 }
}
