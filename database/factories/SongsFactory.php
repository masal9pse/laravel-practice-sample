<?php

use Faker\Generator as Faker;
use App\Models\Song;

$factory->define(Song::class, function (Faker $faker) {
 return [
  'title' => $faker->sentence(rand(1, 4)), // 1〜4つの単語で文章
  'detail' => $faker->realText(512), // 512文字の文章
  'file_name' => '',
 ];
});
