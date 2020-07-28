<?php

use Faker\Generator as Faker;
use App\Models\Song;

$factory->define(Song::class, function (Faker $faker) {
 return [
  'title' => '今夜このまま',
  'detail' => '苦いようで甘いような〜',
  'file_name' => '',
 ];
});
