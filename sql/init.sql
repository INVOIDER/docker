CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT,DELETE ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
CREATE TABLE IF NOT EXISTS users (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    login VARCHAR(20) NOT NULL,
    password VARCHAR(40) NOT NULL,
    PRIMARY KEY (ID)
);

INSERT INTO users (login, password)
SELECT * FROM (SELECT 'Petr', '1234') AS tmp
WHERE NOT EXISTS (
    SELECT login FROM users WHERE login = 'Petr' AND password = '1234'
) LIMIT 1;

INSERT INTO users (login, password)
SELECT * FROM (SELECT 'Gennadiy', '123') AS tmp
WHERE NOT EXISTS (
    SELECT login FROM users WHERE login = 'Gennadiy' AND password = '123'
) LIMIT 1;

INSERT INTO users (login, password)
SELECT * FROM (SELECT 'Galina', '111') AS tmp
WHERE NOT EXISTS (
    SELECT login FROM users WHERE login = 'Galina' AND password = '111'
) LIMIT 1;

INSERT INTO users (login, password)
SELECT * FROM (SELECT 'Svetlana', '222') AS tmp
WHERE NOT EXISTS (
    SELECT login FROM users WHERE login = 'Svetlana' AND password = '222'
) LIMIT 1;

INSERT INTO users (login, password)
SELECT * FROM (SELECT 'Arkadiy', '333') AS tmp
WHERE NOT EXISTS (
    SELECT login FROM users WHERE login = 'Arkadiy' AND password = '333'
) LIMIT 1;


CREATE TABLE IF NOT EXISTS products (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    product VARCHAR(50) NOT NULL,
    price VARCHAR(20) NOT NULL,
    PRIMARY KEY (ID)
);

INSERT INTO products (product, price)
SELECT * FROM (SELECT 'processed almette cheese', '110') AS tmp
WHERE NOT EXISTS (
    SELECT product FROM products WHERE product = 'processed almette cheese' AND price = '110'
) LIMIT 1;

INSERT INTO products (product, price)
SELECT * FROM (SELECT 'Cottage cheese B.Y.Alexandrov', '60') AS tmp
WHERE NOT EXISTS (
    SELECT product FROM products WHERE product = 'Cottage cheese B.Y.Alexandrov' AND price = '60'
) LIMIT 1;

INSERT INTO products (product, price)
SELECT * FROM (SELECT 'Sour cream Prostokvashino', '91') AS tmp
WHERE NOT EXISTS (
    SELECT product FROM products WHERE product = 'Sour cream Prostokvashino' AND price = '91'
) LIMIT 1;

INSERT INTO products (product, price)
SELECT * FROM (SELECT 'Banana', '100') AS tmp
WHERE NOT EXISTS (
    SELECT product FROM products WHERE product = 'Banana' AND price = '100'
) LIMIT 1;

INSERT INTO products (product, price)
SELECT * FROM (SELECT 'Green Ray Polka Dots', '69') AS tmp
WHERE NOT EXISTS (
    SELECT product FROM products WHERE product = 'Green Ray Polka Dots' AND price = '69'
) LIMIT 1;
