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