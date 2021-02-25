-- このサイトで練習
--https://www.w3schools.com/sql/trysql.asp?filename=trysql_op_in
-- 従業員の中で誰が一番稼いだかを上から順にリスト化する
select *, sum(Price) make_money_shipperID
from Products
 join Shippers sp on sp.ShipperID = Products.SupplierID
group by sp.ShipperID
order by make_money_shipperID desc

select count(song_tag.tag_id)
from songs inner join song_tag on songs.id=song_tag.song_id
group by song_tag.tag_id


SELECT *
FROM songs
WHERE EXISTS (SELECT count(tag_id)
FROM song_tag
WHERE songs.id = song_tag.song_id
HAVING count(tag_id) = 2)

-- joinを使わずにwhereで結合
SELECT * from Orders od,OrderDetails ot where od.orderID=ot.orderID