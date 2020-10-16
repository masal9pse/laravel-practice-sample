<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
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
  $data = "https://www.googleapis.com/books/v1/volumes?q=東野圭吾&startIndex=1&maxResults=20";
  // $data = "https://www.googleapis.com/books/v1/volumes?q=湊かなえ&startIndex=1&maxResults=20";
  $json = file_get_contents($data);
  $json_decode = json_decode($json);
  // jsonデータ内の『entry』部分を複数取得して、postsに格納
  $books = $json_decode->items;
  // echo '<pre>';
  // var_dump($books);
  // echo '<pre>';

  $insert_data_sql = "INSERT INTO books (user_id,title,author,thumbnail,description,created_at) VALUES (:user_id,:title,:author,:thumbnail,:description,NOW())";
  $insert_data = $db->prepare($insert_data_sql);

  // 挿入する値を配列に格納する
  foreach ($books as $book) {
   // var_dump($book);  
   // タイトル
   $user_id = rand(1, 50);
   $title = $book->volumeInfo->title;
   // 説明
   $description = $book->volumeInfo->description;
   // サムネ画像
   $thumbnail = $book->volumeInfo->imageLinks->thumbnail;
   // 著者（配列なのでカンマ区切りに変更）
   $authors = implode(',', $book->volumeInfo->authors);

   $insert = array('user_id' => $user_id, ':title' => $title, ':author' => $authors, ':thumbnail' => $thumbnail, ':description' => $description);
   $insert_data->execute($insert);
   //$insert_data->execute($book);
  }
  echo "テーブルに保存完了です";
 }
}
