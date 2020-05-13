<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
 /**
  * Run the database seeds.
  *
  * @return void
  */
 public function run()
 {
  User::create(
   [
    'name' => 'マサト',
    'email' => 'test@test.com',
    'password' => bcrypt('password123'),
    'created_at'     => now(),
    'updated_at'     => now()
   ]
  );
  factory(App\Models\User::class, 50)->create();
 }
}
