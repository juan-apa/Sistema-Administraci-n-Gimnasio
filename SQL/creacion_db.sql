DROP DATABASE IF EXISTS Gimnasio;
CREATE DATABASE Gimnasio;
USE Gimnasio;

CREATE TABLE Gimnasio.Roles(
	idRol int(2) PRIMARY KEY,
    rol VARCHAR(20)
);

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
    FOREIGN KEY (idRol) REFERENCES Roles(idRol)
);

CREATE TABLE Gimnasio.Rutinas(
	idUsuario INT NOT NULL,
    fechaInicio DATE,
    idRutina int not null,
    PRIMARY KEY(idUsuario, idRutina),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario)
);

CREATE TABLE Gimnasio.Ejercicios(
	idEjercicio INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idRutina INT NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    repeticiones INT,
    series INT,
    peso int,
    FOREIGN KEY (idRutina) REFERENCES Rutinas(idRutina)
);