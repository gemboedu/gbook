DROP DATABASE IF EXISTS gbook_db;
CREATE DATABASE gbook_db;
USE gbook_db;

-- table roles
CREATE TABLE roles(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255)
)ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO roles(name,description) VALUES
('DBA','Administrador que tiene todos los permisos para la administración del sistema y base de datos'),
('ADMIN','Administrador con ciertas restricciones'),
('DEV','Permisos para el dearrollador'),
('CUSTOMER','Cliente de la aplicación');

CREATE TABLE profiles(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(64) NOT NULL,
    document VARCHAR(32),
    phone VARCHAR(32),
    nickname VARCHAR(30),
    address VARCHAR(100),
    email VARCHAR(150) NOT NULL UNIQUE,
    photo VARCHAR(255),
    registed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE accounts(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_role INT UNSIGNED NOT NULL,
    id_profile INT UNSIGNED UNIQUE,
    password VARCHAR(255) NOT NULL,
    status TINYINT(1) NOT NULL DEFAULT 1,
    last_connection TIMESTAMP,
    FOREIGN KEY (id_profile) REFERENCES profiles(id) ON UPDATE CASCADE,
    FOREIGN KEY (id_role) REFERENCES roles(id) ON UPDATE CASCADE
)ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE interests(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255)
)ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE myinterests(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_profile INT UNSIGNED NOT NULL,
    id_interest INT UNSIGNED NOT NULL,
    FOREIGN KEY (id_profile) REFERENCES profiles(id) ON UPDATE CASCADE,
    FOREIGN KEY (id_interest) REFERENCES interests(id) ON UPDATE CASCADE
)ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;