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

CREATE TABLE account(
    idaccount int primary key auto_increment,
    iduser int not null,
    name varchar(50) not null,
    type ENUM('checking', 'savings', 'wallet', 'investment') not null default 'checking',
    initial_balance decimal(12,2) not null default 0,
    created_at TIMESTAMP DEFAULT current_timestamp,
    FOREIGN KEY (iduser) REFERENCES user(iduser) ON DELETE CASCADE
);

CREATE TABLE category(
    idcategory int primary key auto_increment,
    iduser int not null,
    name varchar(50) not null,
    type ENUM('income', 'expense') not null,
    created_at TIMESTAMP DEFAULT current_timestamp,
    FOREIGN KEY (iduser) REFERENCES user(iduser) ON DELETE CASCADE,
    UNIQUE (iduser, name, type)
);

CREATE TABLE transaction(
    id int primary key auto_increment,
    iduser int not null,
    idaccount int not null,
    idcategory int not null,
    type ENUM('income', 'expense') not null,
    amount decimal(10,2) not null,
    status ENUM('paid', 'pending') not null default 'paid',
    description varchar(255),
    transaction_date DATE not null,
    due_date DATE,
    created_at TIMESTAMP DEFAULT current_timestamp,
    FOREIGN KEY (iduser) REFERENCES user(iduser) ON DELETE CASCADE,
    FOREIGN KEY (idaccount) REFERENCES account(idaccount),
    FOREIGN KEY (idcategory) REFERENCES category(idcategory)
);