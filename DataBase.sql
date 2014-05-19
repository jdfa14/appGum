DROP DATABASE IF EXISTS appGym;
CREATE DATABASE appGym;

USE appGym;

DROP USER 'usuario'@'localhost';
DROP USER 'admin'@'localhost';

CREATE USER 'usuario'@'localhost' IDENTIFIED BY 'paydelimon';
GRANT SELECT, DELETE, INSERT, UPDATE 
	ON appGym.* TO 'usuario'@'localhost';

CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin';
GRANT SELECT, DELETE, INSERT, UPDATE 
	ON appGym.* TO 'admin'@'localhost';



CREATE TABLE member (
    username VARCHAR(10) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    password CHAR(128) NOT NULL,
    PRIMARY KEY (username)
);


CREATE TABLE login_attempts (
    user_id INT(11) NOT NULL,
    time VARCHAR(30) NOT NULL
);

create table alumno(
	idAlumno varchar(10) NOT NULL,
	nombre varchar(45) NOT NULL,
	apellido varchar(45) NOT NULL,
	correo varchar(25) DEFAULT NULL,
	peso decimal(10,0) DEFAULT NULL,
	nacimiento date NOT NULL,
	rutinaJsonActual int,
	sexo varchar(10) NOT NULL,
	contrasena varchar(45) NOT NULL,
	PRIMARY KEY (idAlumno)
);

CREATE TABLE alumnoinstructor (
	idAlumno VARCHAR(10) NOT NULL,
	idInstructor VARCHAR(10) NOT NULL,
	fechaRegistro DATE NOT NULL,
	fechaFinal DATE,
	definicion text,
	PRIMARY KEY (idAlumno, idInstructor,fechaRegistro),
	foreign key (idAlumno) references alumno(idAlumno),
	foreign key (idInstructor) references member(username)
);

create table rutina (
	numRutina int not null auto_increment primary key,
	idAlumno int not null,
	dia0 date not null,
	pesoInicial double not null,
	pesoFinal double not null
);

-- select 'addfk';
	
-- select 'ejercicio';

create table ejercicio(
	nombre varchar(30) not null,
	descripcion varchar(130) not null,
	musculo varchar(30) not null,
	archivo varchar(65) not null,
	primary key(nombre, musculo)
);

-- select 'rutina_ejercicio';

create table rutina_ejercicio(
	numRutina int not null,
	idEjercicio int not null,
	dia int not null,
	
	series int not null,
	repeticiones int not null,
	avance int not null,
	comentario varchar(150),
	
	primary key(numRutina, idEjercicio, dia), 
	foreign key(idEjercicio) references ejercicio(idEjercicio),
	foreign key(numRutina) references rutina(numRutina)
);

-- INSERT INTO member VALUES(1, 'test_user', 'test@example.com','00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc','f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef');
