<?php

use Faker\Generator as Faker;
use App\Admin;

$factory->define(Admin::class, function (Faker $faker) {
 return [
  'name' => 'admin2',
  'email' => 'admin@admin2.com',
  'password' => bcrypt('password123'),
 ];
});
