-- このサイトで練習
--https://www.w3schools.com/sql/trysql.asp?filename=trysql_op_in
-- 従業員の中で誰が一番稼いだかを上から順にリスト化する
select *, sum(Price) make_money_shipperID
from Products
 join Shippers sp on sp.ShipperID = Products.SupplierID
group by sp.ShipperID
order by make_money_shipperID desc