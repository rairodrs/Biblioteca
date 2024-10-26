-- DDL COMANDOS DE ESTRUTURA 

create database faturamento;
use faturamento;
-- drop database faturamento;

-- drop table cliente; 
create table cliente(
cpf bigint not null primary key,
nome varchar(30) not null,
logradouro varchar(40) not null,
bairro varchar(30) not null
);

create table notaFiscal(
numeroNota int not null primary key auto_increment,
cpf bigint not null,
dataFaturamento date not null,
foreign key (cpf) references cliente(cpf)
);

create table produto(
codigoProduto int not null primary key auto_increment,
descricao varchar(200)
);

create table itemNota(
numeroNota int not null,
codigoProduto int not null,
foreign key (numeroNota) references NotaFiscal(numeroNota),
foreign key (codigoProduto) references Produto(codigoProduto)
);

-- DML COMANDOS DE MANIPULAÇÃO DE DADOS
INSERT INTO CLIENTE(CPF,NOME,LOGRADOURO,BAIRRO) VALUES
(23514789654,"João da Silva","Rua nove de julho, 1500","Centro"),
(54157855555,"Maria da Silva","Rua nove de julho, 1500","Centro"),
(25417885699,"Sebastião dos Santos","Rua São Bento, 100","jd Primavera");
-- select * from cliente;
-- select nome from cliente;

INSERT INTO PRODUTO(DESCRICAO) VALUES
("Coca-cola 2l"),
("Guarana antartica 2l"),
("Mimosa 2l"),
("Roller 2l"),
("Fanta 1,5l"),
("Sprite lata");
-- select * from produto;

INSERT INTO NOTAFISCAL(CPF,DATAFATURAMENTO) VALUES
(23514789654,"2022-02-10"),
(54157855555,"2022-02-10"),
(25417885699,"2022-02-11");

select * from notafiscal;

INSERT INTO ITEMNOTA(NUMERONOTA,CODIGOPRODUTO)VALUES
(1,1),
(1,5),
(2,4),
(2,6),
(3,3);