<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentIdForeignKeyToRepliesTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::table('replies', function (Blueprint $table) {
   $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
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
   $table->dropForeign('replies_comment_id_foreign');
  });
 }
}
