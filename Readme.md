
How to create bennezai database : 

create database bennezai;

use bennezai

create table user (user_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT, user VARCHAR(40) NOT NULL, password VARCHAR(40) NOT NULL, PRIMARY KEY (user_id) ) ENGINE=INNODB;