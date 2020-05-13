<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
 /**
  * Run the database seeds.
  *
  * @return void
  */
 public function run()
 {
  Tag::create(
   [
    'title' => '声がいい',
    'created_at'     => now(),
    'updated_at'     => now()
   ],
   [
    'title' => 'おっとりしている',
    'created_at'     => now(),
    'updated_at'     => now()
   ],
   [
    'title' => 'アップテンポ',
    'created_at'     => now(),
    'updated_at'     => now()
   ],
   [
    'title' => '怖い',
    'created_at'     => now(),
    'updated_at'     => now()
   ],
   [
    'title' => 'サビがいい',
    'created_at'     => now(),
    'updated_at'     => now()
   ]
  );
 }
}
