CREATE DATABSE IF NOT EXISTS ControlHubdb;

USE ControlHubdb;

CREATE TABLE IF NOT EXISTS users
(
    id int primary key not null AUTO_INCREMENT,
    user varchar(20) not null,
    password varchar(255) not null,
    token varchar(128) not null
)