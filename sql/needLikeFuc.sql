-- いいねしているかを判定するために必要なsql
select *
from likes
where user_id = ? and song_id = ?;

--　いいねをインサートする処理
INSERT INTO likes
 (song_id,user_id)
values
 (:song_id, :user_id)

-- いいねを解除する処理
DELETE FROM likes WHERE post_id = :post_id AND user_id = :user_id