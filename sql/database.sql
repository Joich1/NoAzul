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
    id int auto_increment primary key,
    iduser int not nul,
    type ENUM('income', 'expense') not null,
    amount decimal(10,2) not null,
    category varchar(50),
    description varchar(255),

);