CREATE DATABASE noazul;
USE noazul;

CREATE TABLE user(
    iduser int primary key auto_increment,
    nome varchar(100),
    email varchar(100),
    senha varchar(255),
    imagem varchar(100),
    data_criacao TIMESTAMP DEFAULT current_timestamp
);

CREATE TABLE transaction(
    idtran INT PRIMARY KEY auto_increment,
    iduser int,
    amount decimal(10,2),
    category varchar(50),
    description varchar(255),

);