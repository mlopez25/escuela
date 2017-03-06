create database actividades default character set utf8 collate utf8_unicode_ci;

create user uactividades@localhost identified by 'pastividades';

grant all on actividades.* to uactividades@localhost;

flush privileges;

use actividades;

create table actividad(
    idActividad int auto_increment not null primary key,
    profesor int not null,
    departamento int not null, 
    grupo int not null,
    titulo varchar(500) not null,
    descripcion varchar(10000) not null,
    fecha date not null,
    lugar varchar(250) not null,
    horaInicio time,
    horaFinal time,
    imagen varchar(250),
    foreign key(profesor) references profesor(idProfesor) on delete cascade on update cascade,
    foreign key(grupo) references grupo(idGrupo) on delete cascade on update cascade,
    foreign key(departamento) references departamento(idDepartamento) on delete cascade on update cascade
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

create table profesor(
    idProfesor int auto_increment not null primary key,
    nombre varchar(250) not null,
    password varchar(250) not null,
    departamento varchar(250) not null,
    directivo boolean not null
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

create table grupo(
    idGrupo int auto_increment not null primary key,
    nombre varchar(250) not null,
    nivel varchar(250) not null
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

create table departamento(
    idDepartamento int auto_increment not null primary key,
    departamento varchar(250) not null
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;