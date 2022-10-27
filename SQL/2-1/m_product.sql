create table m_product (
product_code int(3) ZEROFILL AUTO_INCREMENT primary key, 
product_name varchar(50) NOT NULL,
price INT NOT NULL,
register_datetime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
update_datetime  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
delete_datetime datetime
);