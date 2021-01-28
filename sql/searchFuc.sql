select *
from songs
 -- inner joinだったら狙い通りを検索結果にならなかった。仮説だがおそらくleftjoinだとjoinしていないカラムも出力できると思う。
 left join comments on songs.id = comments.song_id
where songs.title like '%マリーゴールド%' or comments.comment like '%い%';