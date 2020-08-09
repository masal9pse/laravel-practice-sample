<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('replies', function (Blueprint $table) {
   $table->increments('id');

   $table->integer('comment_id')->unsigned();
   $table->integer('song_id')->unsigned();

   $table->string('reply')->nullable();

   // $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
   $table->timestamps();
  });
 }

 /**
  * Reverse the migrations.
  *
  * @return void
  */
 public function down()
 {
  Schema::dropIfExists('replies');
 }
}
