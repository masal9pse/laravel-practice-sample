<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSongIdToRepliessTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::table('replies', function (Blueprint $table) {
   $table->integer('song_id')->unsigned()->after('comment_id');

   $table->foreign('song_id')->references('id')->on('songs')->onDelete('cascade');
  });
 }

 /**
  * Reverse the migrations.
  *
  * @return void
  */
 public function down()
 {
  Schema::table('replies', function (Blueprint $table) {
   $table->dropColumn('song_id');
  });
 }
}
