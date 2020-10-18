<?php

use Illuminate\Database\Seeder;

class SongsBooksTableSeeder extends Seeder
{
 /**
  * Run the database seeds.
  *
  * @return void
  */
 // まずuriのデータを取得して、そして配列に入れる、その後シードメソッドを使えばいけそう。
 public function run()
 {
  $db = DB::connection()->getPdo();
  //dd($db);
  $data = "https://www.googleapis.com/books/v1/volumes?q=東野圭吾&startIndex=1&maxResults=2";
  $json = file_get_contents($data);
  $json_decode = json_decode($json);
  // jsonデータ内の『entry』部分を複数取得して、postsに格納
  $books = $json_decode->items;
  //dd($books);
  $insert_data_sql = "INSERT INTO songs (user_id,title,detail,created_at) VALUES (:user_id,:title,:detail,NOW())";
  $insert_data = $db->prepare($insert_data_sql);

  // 挿入する値を配列に格納する
  foreach ($books as $book) {
   // var_dump($book);  
   // タイトル
   $user_id = rand(1, 50);
   $title = $book->volumeInfo->title;
   //dd($title);
   // 説明
   $detail = $book->volumeInfo->description;
   //dd($detail);
   // サムネ画像
   //$thumbnail = $book->volumeInfo->imageLinks->thumbnail;
   // 著者（配列なのでカンマ区切りに変更）
   //$authors = implode(',', $book->volumeInfo->authors);

   //$insert = array('user_id' => $user_id, ':title' => $title, ':author' => $authors, '' => $thumbnail, ':detail' => $detail);
   $insert = array('user_id' => $user_id, ':title' => $title, ':detail' => $detail);
   $insert_data->execute($insert);
  }
  echo "テーブルに保存完了です";
 }
}
