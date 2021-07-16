/* ■ [回答]と記載のある箇所へ、1〜8の各課題内容に沿ったSQL文を記述しなさい。 */
 
-- 1. 店舗テーブルから店舗名を抽出しなさい。また、列名の表示は別名で'店舗名'とすること。
-- [回答]
 select store_name AS 店舗名 from store_table
 
-- 2. 店舗情報を店舗名のABC順に抽出しなさい。
-- [回答]
 SELECT * FROM store_table ORDER BY store_nameabc
 
-- 3. 在庫テーブルに店舗テーブル、商品テーブルを「内部結合」し、店舗名・商品名・在庫数を全て取得しなさい。
-- [回答]
 SELECT store_name, goods_name, quantity
FROM stock_table INNER JOIN store_table ON stock_table.update_day=store_table.update_day
INNER JOIN goods_table ON stock_table.goods_code=goods_table.goods_code
 
-- 4. 商品テーブルから全商品の単価の平均値を抽出しなさい。
-- [回答]
 SELECT AVG(price) FROM goods_table
 
-- 5. 店舗コード='EA01'の在庫数の平均値より大きい在庫数を持つ店舗コードを抽出しなさい。
-- [回答]
SELECT store_code FROM stock_table WHERE quantity >=(select avg(quantity) from stock_table　where store_code='EA01')
 
 
-- 6. 商品テーブルに「商品コード='M001'、商品名='マフラー'、単価=4500円、更新日付=本日日付」のデータを追加しなさい。※実行後のSELECT結果も貼付すること。
-- [回答]
 INSERT INTO goods_table
(goods_code, goods_name,price,update_day )
VALUES
('M001', 'マフラー','4500','2021-07-09' )
 
-- 7. 在庫テーブルの商品コード='S987'、かつ、店舗コード='EA01'に対して、「在庫数=10、更新日付=本日日付」で更新しなさい。※実行後のSELECT結果も貼付すること。
-- [回答]
 UPDATE stock_table
SET
quantity = '10',
update_day = '2021-07-09'
WHERE
goods_code = 'S987' AND store_code = 'EA01'

 
-- 8. 7で更新した商品を削除しなさい。※実行後のSELECT結果も貼付すること。
-- [回答]
DELETE FROM stock_table WHERE update_day = '2021-07-09';


CREATE TABLE store_table(
store_code CHAR(4) NOT NULL,
store_name VARCHAR(20) NOT NULL,
store_nameAbc VARCHAR(50) NOT NULL,
update_day DATE NOT NULL,
CONSTRAINT pk_store PRIMARY KEY(store_code))
;
CREATE TABLE goods_table(
goods_code CHAR(4) NOT NULL,
goods_name VARCHAR(50) NOT NULL,
price INTEGER  NULL,
update_day DATE NOT NULL,
PRIMARY KEY(goods_code)
)
;
CREATE TABLE stock_table(
goods_code CHAR(4) NOT NULL,
store_code CHAR(4) NOT NULL,
quantity INTEGER  NULL,
update_day DATE NOT NULL）
;
INSERT INTO store_table(
store_code, store_name, store_nameAbc, update_day) 
VALUES('EA01','札幌店','SAPPOROTEN','2000-01-01'),
('EA02','仙台店','SENDAITEN','2000-03-01'),
('EA03','郡山店','KOORIYAMATEN','2000-04-01'),
('EA04','宇都宮店','UTSUNOMIYATEN','2005-04-01'),
('EA05','埼玉店','SAITAMATEN','2005-07-01'),
('EA06','丸の内店','MARUNOUTHITEN','2008-03-01'),
('EA07','横浜店','YOKOHAMATEN','2009-03-01'),
('EA08','千葉店','CHIBATEN','2009-04-01'),
('WE01','栄店','SAKAETEN','2010-03-01'),
('WE02','心斎橋店','SHINSAIBASHITEN','2011-03-01')
;
	INSERT INTO goods_table(
goods_code, goods_name, price, update_day) 
VALUES	('S987','セーター','29000','2000-05-01'),
('M032','マフラー','7000','2000-07-01'),
('K209','カットソー','12000','2003-01-01'),
('Z939','ジーンズ','40000','2004-01-01'),
('B345','ドカジャン','8000','2005-06-01'),
('M286','マフラー','4000','2006-08-01'),
('P175','パーカー','20000','2009-11-01'),
('K206','カットソー','5000','2010-01-01'),
('K456','カットソー','26000','2011-02-01'),
('N094','ニット','3000','2012-01-01')
;
INSERT INTO stock_table(
goods_code,store_code, quantity, update_day) 	
VALUES ('S987','EA01','20','2000-06-01'),
('S987','EA03','10','2000-06-23'),
('M032','EA02','0','2000-07-01'),
('K209','EA03','13','2000-09-01'),
('K209','EA05','1','2000-09-01'),
('K209','EA07','5','2000-09-01'),
('Z939','EA04','10','2004-05-01'),
('Z939','EA08','30','2004-05-01'),
('B345','EA05','13','2005-05-01'),
('B345','WE01','11','2005-05-01'),
('M286','EA06','23','2006-12-01'),
('M286','EA07','22','2006-12-01'),
('M286','WE02','15','2006-12-01'),
('P175','EA07','16','2007-04-01'),
('K206','EA01','17','2007-05-01'),
('K206','EA08','8','2007-05-01'),
('P093','EA01','15','2009-09-01'),
('P093','WE01','0','2009-09-01'),
('N094','WE02','30','2010-05-01')