CREATE DATABASE noazul;
USE noazul;

CREATE TABLE user(
    iduser int primary key auto_increment,
    nome varchar(100) not null,
    email varchar(100) not null,
    senha varchar(255) not null,
    imagem varchar(100),
    data_criacao TIMESTAMP DEFAULT current_timestamp
);

CREATE TABLE transaction(
    id int primary key auto_increment,
    iduser int not null,
    type ENUM('income', 'expense') not null,
    amount decimal(10,2) not null,
    category varchar(50),
    description varchar(255),
    transaction_date DATE not null,
    created_at TIMESTAMP DEFAULT current_timestamp,
    FOREIGN KEY (iduser) REFERENCES user(iduser) ON DELETE CASCADE

);

CREATE TABLE account(
    idaccount int primary key auto_incrment,
    iduser int not null,
    name varchar(50) not null,
    name varchar(50) not null,
);