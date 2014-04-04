DROP DATABASE IF EXISTS appGym;
CREATE DATABASE appGym;

CREATE USER 'appGym'@'localhost' IDENTIFIED BY 'ivdida';
GRANT SELECT, DELETE, INSERT, UPDATE ON appGym.* TO 'sec_user'@'localhost';

CREATE TABLE appGym.member (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password CHAR(128) NOT NULL,
    salt CHAR(128) NOT NULL 
) ENGINE = InnoDB;

CREATE TABLE appGym.login_attempts (
    user_id INT(11) NOT NULL,
    time VARCHAR(30) NOT NULL
) ENGINE=InnoDB;

create table appGym.ejercicio(
	idEjercicio int not null primary key,
	nombre varchar(30) not null,
	descripcion varchar(30) not null,
	musculo varchar(30) not null
)engine = InnoDB;

create table appGym.rutina (
	idAlumno int not null,
	numRutina int not null,
	dia0 date not null,
	pesoInicial double not null,
	pesoFinal double not null,
	primary key (idAlumno, numRutina)
)engine=InnoDB;


create table appGym.rutina_ejercicio(
	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	idAlumno int not null,
	numRutina int not null,
	idEjercicio int not null,
	dia int not null,
	
	series int not null,
	repeticiones int not null,
	avance int not null,
	primary key(idAlumno, numRutina, idEjercicio, dia), -- what??? 4 se necesitan para ser unico
	foreign key(idEjercicio) references ejercicio(idEjercicio),
	foreign key(idAlumno, numRutina) references rutina(idAlumno, numRutina)
)engine = InnoDB;

create table appGym.alumno(
	idAlumno int not null primary key,
	edad int not null,
	peso double not null,
	sexo varchar(2) not null,
	foreign key idAlumno references member(id)
)engine = InnoDB;

create table appGym.Instructor(
	idInstructor int not null primary key,
	tipo varchar(10),
	foreign key idInstructor references member(id)
)engine = InnoDB;

INSERT INTO appGym.members VALUES(1, 'test_user', 'test@example.com',
'00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc',
'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef');
