CREATE DATABASE IF NOT EXISTS pizzaria;
USE pizzaria;

alter database pízzaria character set utf8 collate utf8_general_ci;

CREATE TABLE IF NOT EXISTS tab_cadastro(
cod_cliente INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(50),
endereco VARCHAR(50),
tamanho VARCHAR(10),
sabor1 VARCHAR(30),
sabor2 VARCHAR(30)
);