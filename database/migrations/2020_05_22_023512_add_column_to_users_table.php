<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToUsersTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::table('users', function (Blueprint $table) {
   $table->string('self_introduction', 500)->nullable();
   $table->tinyInteger('sex')->default(0);
   $table->string('img_name')->default('');
  });
 }

 /**
  * Reverse the migrations.
  *
  * @return void
  */
 public function down()
 {
  //
 }
}
