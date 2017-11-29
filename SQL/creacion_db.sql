DROP DATABASE IF EXISTS Gimnasio;
CREATE DATABASE Gimnasio;
USE Gimnasio;

CREATE TABLE Gimnasio.Roles(
	idRol int(2) PRIMARY KEY,
    rol VARCHAR(20)
);

insert into Gimnasio.Roles VALUES(0, 'ADMINISTRADOR');
insert into Gimnasio.Roles VALUES(1, 'WEBMASTER');
insert into Gimnasio.Roles VALUES(2, 'USUARIO');

CREATE TABLE Gimnasio.Usuarios(
	idUsuario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(20) not null,
    apellido varchar(20) not null,
    cedula int not null,
    direccion VARCHAR(100) NOT NULL,
    fechaNacimiento DATE,
    socMedica VARCHAR(40),
    emerMovil VARCHAR(40),
    antecedentes VARCHAR(400),
    observaciones VARCHAR(400),
    valido INT(1),
    idRol int(2),
    contrasenia VARCHAR(100),
    FOREIGN KEY (idRol) REFERENCES Roles(idRol)
);

CREATE TABLE Gimnasio.Rutinas(
	idUsuario INT NOT NULL,
    fechaInicio DATE,
    idRutina int not null,
    nombreRutina VARCHAR(40),
    PRIMARY KEY(idUsuario, idRutina),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario)
);

CREATE TABLE Gimnasio.Ejercicios(
	idEjercicio INT NOT NULL AUTO_INCREMENT,
    idRutina INT NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    repeticiones INT,
    series INT,
    peso int,
    PRIMARY KEY (idEjercicio, idRutina),
    FOREIGN KEY (idRutina) REFERENCES Rutinas(idRutina)
);

CREATE TABLE Gimnasio.Telefonos(
	idUsuario INT NOT NULL,
    telefono INT NOT NULL,
    PRIMARY KEY (idUsuario, telefono),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario)
);
