<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToSongsTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::table('songs', function (Blueprint $table) {
   $table->integer('likes_count')->default(0)->after('detail');
  });
 }

 /**
  * Reverse the migrations.
  *
  * @return void
  */
 public function down()
 {
  Schema::table('songs', function (Blueprint $table) {
   $table->dropColumn('likes_count');
  });
 }
}
