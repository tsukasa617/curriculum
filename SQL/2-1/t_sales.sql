create table t_sales (
sales_date DATE, 
product_code int(3) ZEROFILL, 
quantity INT NOT NULL,
register_datetime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
update_datetime  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


alter table t_sales add primary key(sales_date,product_code);