-- Para eliminar la base descomentar la línea de acá abajo
 DROP DATABASE heladosya;
--

CREATE DATABASE IF NOT EXISTS heladosya;
USE heladosya;

CREATE TABLE IF NOT EXISTS usuarios (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nombre varchar(15),
    apellido varchar(20),
    contra varchar(20),
    email varchar(30),
    direccion varchar(30)
);

INSERT INTO usuarios VALUES
(default,"Juan","Perez","1234","jp@gmail.com","Mitre 561");

SELECT * FROM usuarios;