DROP DATABASE IF EXISTS appGym;
CREATE DATABASE appGym;

USE appGym;

DROP USER 'usuario'@'localhost';
CREATE USER 'usuario'@'localhost' IDENTIFIED BY 'paydelimon';
GRANT SELECT, DELETE, INSERT, UPDATE 
	ON appGym.* TO 'usuario'@'localhost';

-- select 'member';	

CREATE TABLE member (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    password CHAR(128) NOT NULL,
    salt CHAR(128) NOT NULL,
    tipo ENUM('a', 'i') not null
) ENGINE = InnoDB;

-- select 'login_attempts';

CREATE TABLE login_attempts (
    user_id INT(11) NOT NULL,
    time VARCHAR(30) NOT NULL
) ENGINE=InnoDB;

-- select 'instructor';

create table instructor(
	idInstructor int not null primary key,
	foreign key (idInstructor) references member(id)
)engine = InnoDB;

-- select 'alumno';

create table alumno(
	idAlumno int not null primary key,
	
	instructor int,
	rutinaActual int,
	nacimiento date,
	peso double,
	sexo enum('f', 'm') not null,
	foreign key (idAlumno) references member(id),
	foreign key (instructor) references instructor(idInstructor)
)engine = InnoDB;

-- select 'rutina';

create table rutina (
	numRutina int not null auto_increment primary key,
	idAlumno int not null,
	dia0 date not null,
	pesoInicial double not null,
	pesoFinal double not null
)engine=InnoDB;

-- select 'addfk';

alter table alumno add
foreign key(rutinaActual) references rutina(numRutina);
	
-- select 'ejercicio';

create table ejercicio(
	idEjercicio int not null primary key,
	nombre varchar(30) not null,
	descripcion varchar(30) not null,
	musculo varchar(30) not null
)engine = InnoDB;

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
)engine = InnoDB;

-- INSERT INTO member VALUES(1, 'test_user', 'test@example.com','00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc','f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef');
