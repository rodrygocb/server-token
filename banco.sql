CREATE DATABASE bd3_redes;

USE bd3_redes;

CREATE TABLE usuarios (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  senha VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY (email)
);

CREATE TABLE tokens (
  id INT(11) NOT NULL AUTO_INCREMENT,
  available_tokens INT(11) NOT NULL,
  PRIMARY KEY (id)
);