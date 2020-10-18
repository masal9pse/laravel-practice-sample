<?php

use Faker\Generator as Faker;
use App\Book;

$factory->define(App\Book::class, function (Faker $faker) {
 return [
  'title' => $faker->word(),
  'author' => $faker->name()
 ];
});
