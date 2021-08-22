USE cursophp;

create table usuarios
(
 id int not null auto_increment,
 nome varchar(64) not null, 
 email varchar(64) not null,
 idade smallint not null, 
 sexo varchar(1) not null,
 estado_civil varbinary(16) not null,
 humanas tinyint not null, 
 exatas tinyint not null,
 biologicas tinyint not null,
 senha varchar(32) not null,
 primary key(id) 
);

select * from usuarios;