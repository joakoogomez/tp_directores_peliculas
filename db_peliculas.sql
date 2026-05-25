CREATE DATABASE IF NOT EXISTS db_peliculas
CHARACTER SET utf8
COLLATE utf8_spanish_ci;

USE db_peliculas;

CREATE TABLE directores (

    id_director INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,

    fecha_nacimiento DATE NOT NULL,

    edad INT NOT NULL
);

CREATE TABLE peliculas (

    id_pelicula INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,

    fecha_estreno DATE NOT NULL,

    nacionalidad VARCHAR(100) NOT NULL,

    id_director INT NOT NULL,

    FOREIGN KEY (id_director)
    REFERENCES directores(id_director)
);

INSERT INTO directores
(nombre, fecha_nacimiento, edad)
VALUES

('Steven Spielberg', '1946-12-18', 79),

('Quentin Tarantino', '1963-03-27', 63),

('Christopher Nolan', '1970-07-30', 55);

INSERT INTO peliculas
(nombre, fecha_estreno, nacionalidad, id_director)
VALUES

('Jurassic Park', '1993-06-11', 'Estados Unidos', 1),

('E.T.', '1982-06-11', 'Estados Unidos', 1),

('Tiempos violentos', '1994-10-14', 'Estados Unidos', 2),

('Kill Bill', '2003-10-10', 'Estados Unidos', 2),

('El origen', '2010-07-16', 'Estados Unidos', 3),

('Interestelar', '2014-11-07', 'Estados Unidos', 3);