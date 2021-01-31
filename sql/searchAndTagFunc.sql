select *
from songs
 -- inner joinだったら狙い通りを検索結果にならなかった。仮説だがおそらくleftjoinだとjoinしていないカラムも出力できると思う。
 left join comments on songs.id = comments.song_id
where songs.title like '%マリーゴールド%' or comments.comment like '%い%';

-- tagの表示
select *
from tags
 -- joinはinner joinと同じ
 join song_tag on tags.id = song_tag.tag_id
where song_id = 15

INSERT INTO song_tag
 (song_id,tag_id)
VALUES
 (:song_id, :tag_id)

INSERT INTO song_tag
 (song_id,tag_id)
VALUES
 (60, 3)

-- whereHasを使ってカラムの競合を防ぎつつsongsテーブルの値だけ取得。
-- これでpを含んだ歌詞のタイトルで、コメントに'す'が含まれるsongsテーブルのレコードを取得できる
select *
from "songs"
where "title" like '%p%' or exists (select *
 from "comments"
 where "songs"."id" = "comments"."song_id" and "comment" like '%ス%')

-- 投稿の際に紐付けの際にattachを使っている => syncだとin句を使うためよりパフォーマンスの改善が求められる。
-- タグ更新はinが使われていたが、投稿の場合はinが使われなかった。(おそらくリクエストされたバインド値が２つのため)ただ
insert into "song_tag"
 ("song_id", "tag_id")
values
 (?, ?)

-- タグの更新で発行されているSQL
delete from "song_tag" where "song_id" = ? and "tag_id" in (?, ?)

insert into "song_tag"
 ("song_id", "tag_id")
values
 (?, ?)