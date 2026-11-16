DROP DATABASE IF EXISTS noazul;

CREATE DATABASE noazul;
USE noazul;

CREATE TABLE user(
    iduser int primary key auto_increment,
    nome varchar(100) not null unique,
    email varchar(100) not null unique,
    senha varchar(255) not null,
    imagem varchar(100),
    data_criacao TIMESTAMP DEFAULT current_timestamp
);

