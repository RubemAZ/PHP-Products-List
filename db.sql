CREATE TABLE `product_list`.products (
	id INT PRIMARY KEY auto_increment NOT NULL,
	name varchar(100) NOT NULL,
	category varchar(100) NOT NULL,
	description varchar(254) NOT NULL,
	gtin varchar(32) NOT NULL,
	price DECIMAL(9,2) NOT NULL
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_0900_ai_ci;

-- 

ALTER TABLE product_list.products ADD CONSTRAINT gtin UNIQUE KEY (gtin);
