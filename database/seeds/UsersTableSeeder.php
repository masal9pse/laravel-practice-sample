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
  DB::table('users')->insert([
   'name' => 'test',
   'email' => 'test@test.com',
   'password' => bcrypt('password123'),
  ]);
  // factory(App\Models\User::class, 50)->create();
 }
}
