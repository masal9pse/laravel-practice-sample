-- いいねしているかを判定するために必要なsql
select *
from likes
where user_id = ? and song_id = ?;