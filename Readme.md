
How to create bennezai database : 

create database bennezai;

use bennezai

create table user (user_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT, user VARCHAR(40) NOT NULL UNIQUE, password VARCHAR(40) NOT NULL, admin NOT NULL BOOLEAN, PRIMARY KEY (user_id) ) ENGINE=INNODB;