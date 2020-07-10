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
   ]
  );
  Tag::create(
   [
    'title' => 'アップテンポ',
    'created_at'     => now(),
    'updated_at'     => now()
   ]
  );

  Tag::create(
   [
    'title' => 'スローテンポ',
    'created_at'     => now(),
    'updated_at'     => now()
   ]
  );

  Tag::create(
   [
    'title' => 'サビがいい',
    'created_at'     => now(),
    'updated_at'     => now()
   ]
  );

  Tag::create(
   [
    'title' => 'アニソン',
    'created_at'     => now(),
    'updated_at'     => now()
   ]
  );

  Tag::create(
   [
    'title' => 'アカペラ',
    'created_at'     => now(),
    'updated_at'     => now()
   ]
  );

  Tag::create(
   [
    'title' => '映画音楽',
    'created_at'     => now(),
    'updated_at'     => now()
   ]
  );

  Tag::create(
   [
    'title' => '合唱',
    'created_at'     => now(),
    'updated_at'     => now()
   ]
  );

  Tag::create(
   [
    'title' => 'J-POP',
    'created_at'     => now(),
    'updated_at'     => now()
   ]
  );

  Tag::create(
   [
    'title' => 'ジャパニーズメタル',
    'created_at'     => now(),
    'updated_at'     => now()
   ]
  );

  Tag::create(
   [
    'title' => 'あいみょん',
    'created_at'     => now(),
    'updated_at'     => now()
   ]
  );

  Tag::create(
   [
    'title' => 'Official髭男dism',
    'created_at'     => now(),
    'updated_at'     => now()
   ]
  );
 }
}
