DROP DATABASE IF EXISTS quintessentieldb;

CREATE DATABASE quintessentieldb;

USE quintessentieldb;

/* Product table */
CREATE TABLE product (
	id_product INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(128) NOT NULL,
	image_path VARCHAR(255),
	is_sellable BOOLEAN NOT NULL DEFAULT 0,
	description TEXT,
	price DECIMAL(7,2) NOT NULL DEFAULT 0.00,
	quantity INT NOT NULL DEFAULT 0,
	PRIMARY KEY (id_product)
);

/* Recipe table */
CREATE TABLE recipe (
	id_recipe INT NOT NULL AUTO_INCREMENT,
	id_product INT,
	name VARCHAR(255) NOT NULL,
	is_custom BOOLEAN NOT NULL DEFAULT 0,
	steps TEXT,
	description TEXT,
	PRIMARY KEY (id_recipe),
	FOREIGN KEY (id_product) REFERENCES product(id_product)
);

/* Association table for recipe+product */
CREATE TABLE ta_recipe_product (
	id_recipe INT NOT NULL,
	id_product INT NOT NULL,
	qty_ml INT,
	qty_drops INT,
	qty_percent INT,
	PRIMARY KEY (id_recipe, id_product),
	FOREIGN KEY (id_recipe) REFERENCES recipe(id_recipe),
	FOREIGN KEY (id_product) REFERENCES product(id_product)
);

/* Product category table */
CREATE TABLE category (
	id_category INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	is_active BOOLEAN NOT NULL DEFAULT 0,
	description TEXT,
	PRIMARY KEY (id_category)
);

/* Association table for product+category */
CREATE TABLE ta_product_category (
	id_category INT NOT NULL,
	id_product INT NOT NULL,
	PRIMARY KEY (id_category, id_product),
	FOREIGN KEY (id_category) REFERENCES category(id_category),
	FOREIGN KEY (id_product) REFERENCES product(id_product)
);

/* Secret question table */
CREATE TABLE secret_question (
	id_question INT NOT NULL AUTO_INCREMENT,
	question VARCHAR(512) NOT NULL,
	PRIMARY KEY (id_question)
);

/* User table */
CREATE TABLE user (
	id_user INT NOT NULL AUTO_INCREMENT,
	id_question INT NOT NULL,
	username VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	email VARCHAR(512) NOT NULL,
	secret_answer VARCHAR(255) NOT NULL,
	PRIMARY KEY (id_user),
	FOREIGN KEY (id_question) REFERENCES secret_question(id_question)
);

/* Form table */
CREATE TABLE form_answers (
	id_form INT NOT NULL AUTO_INCREMENT,
	id_user INT NOT NULL,
	age INT NOT NULL,
	skintype VARCHAR(64),
	work_environment TEXT,
	desired_effect VARCHAR(255),
	quantity INT,
	fragrance VARCHAR(128),
	essential_oil VARCHAR(128),
	request TEXT,
	comment TEXT,
	PRIMARY KEY (id_form),
	FOREIGN KEY (id_user) REFERENCES user(id_user)
);

/* Order's state table */
CREATE TABLE state (
	id_state INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	description TEXT,
	PRIMARY KEY (id_state)
);

/* Client table */
CREATE TABLE client (
	id_client INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	address VARCHAR(255) NOT NULL,
	city VARCHAR(100) NOT NULL,
	province VARCHAR(32) NOT NULL,
	postal_code VARCHAR(32) NOT NULL,
	PRIMARY KEY (id_client)
);

/* Shipping company table */
CREATE TABLE shipping_company (
	id_company INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	PRIMARY KEY (id_company)
);

/* Shipping method table */
CREATE TABLE shipping_method (
	id_method INT NOT NULL AUTO_INCREMENT,
	id_company INT NOT NULL,
	name VARCHAR(255) NOT NULL,
	price DECIMAL(7,2) NOT NULL DEFAULT 0.00,
	PRIMARY KEY (id_method),
	FOREIGN KEY (id_company) REFERENCES shipping_company(id_company)
);

/* Order table */
CREATE TABLE `order` (
	id_order INT NOT NULL AUTO_INCREMENT,
	id_client INT,
	id_user INT,
	id_state INT,
	id_method INT,
	tps DECIMAL(7,2) NOT NULL DEFAULT 0.00,
	tvq DECIMAL(7,2) NOT NULL DEFAULT 0.00,
	total DECIMAL(7,2) NOT NULL DEFAULT 0.00,
	PRIMARY KEY (id_order),
	FOREIGN KEY (id_user) REFERENCES user(id_user),
	FOREIGN KEY (id_client) REFERENCES client(id_client),
	FOREIGN KEY (id_state) REFERENCES state(id_state),
	FOREIGN KEY (id_method) REFERENCES shipping_method(id_method)
);

/* Association table for order+product */
CREATE TABLE ta_order_product (
	id_order INT NOT NULL,
	id_product INT NOT NULL,
	PRIMARY KEY (id_order, id_product),
	FOREIGN KEY (id_order) REFERENCES `order`(id_order),
	FOREIGN KEY (id_product) REFERENCES product(id_product)
);