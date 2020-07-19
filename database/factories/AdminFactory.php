<?php

use Faker\Generator as Faker;
use App\Admin;

$factory->define(Admin::class, function () {
 return [
  'name' => 'admin',
  'email' => 'admin@admin.com',
  'password' => bcrypt('password123'),
 ];
});
