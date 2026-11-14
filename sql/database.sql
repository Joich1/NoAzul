CREATE DATABASE noazul;
USE noazul;

CREATE TABLE user(
    id int primary key auto_increment,
    nome varchar(100),
    email varchar(100),
    senha varchar(255),
    imagem varchar(100),
    data_criacao TIMESTAMP DEFAULT current_timestamp
);



