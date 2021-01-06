-- logitec (camera)
-- freelancer
-- upwork
-- weremote

DROP DATABASE IF EXISTS gbook;
CREATE DATABASE gbook;
USE gbook;

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

CREATE TABLE users(
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

-- INSERT INTO users(name,email) VALUES
-- ('Pamela','pame@gmail.com'),
-- ('Juan','juan@gmail.com'),
-- ('Mariela','ela@gmail.com');

CREATE TABLE accounts(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_role INT UNSIGNED NOT NULL,
    id_user INT UNSIGNED UNIQUE,
    password VARCHAR(255) NOT NULL,
    status TINYINT(1) NOT NULL DEFAULT 1,
    last_connection TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id) ON UPDATE CASCADE,
    FOREIGN KEY (id_role) REFERENCES roles(id) ON UPDATE CASCADE
)ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- INSERT INTO accounts(id_role,id_user,password) VALUES
-- (3,1,'pame123'),
-- (2,2,'juan123'),
-- (4,3,'mariela123');

CREATE TABLE interests(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255)
)ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE myinterests(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_user INT UNSIGNED NOT NULL,
    id_interest INT UNSIGNED NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id) ON UPDATE CASCADE,
    FOREIGN KEY (id_interest) REFERENCES interests(id) ON UPDATE CASCADE
)ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE categories(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255)
)ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE publishers(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(150) NOT NULL UNIQUE,
    country VARCHAR(50) 
)ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE authors(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    country VARCHAR(50) 
)ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE books(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_category INT UNSIGNED NOT NULL,
    id_publisher INT UNSIGNED,
    id_author INT UNSIGNED NOT NULL,
    code VARCHAR(16) NOT NULL UNIQUE,
    isbn VARCHAR(32) UNIQUE,
    title VARCHAR(255) NOT NULL,
    publish_date DATE,
    edition VARCHAR(32),
    pages INT UNSIGNED,
    copies TINYINT(3) DEFAULT 1,
    to_loan TINYINT(1) DEFAULT 1,
    description TEXT,
    cover_url VARCHAR(255),
    digital_url VARCHAR(255),
    registed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_category) REFERENCES categories(id) ON UPDATE CASCADE ON DELETE RESTRICT, 
    FOREIGN KEY (id_publisher) REFERENCES publishers(id) ON UPDATE CASCADE ON DELETE RESTRICT, 
    FOREIGN KEY (id_author) REFERENCES authors(id) ON UPDATE CASCADE ON DELETE RESTRICT 
)ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;





DROP PROCEDURE IF EXISTS p_create_user;
DELIMITER $$;
CREATE PROCEDURE p_create_user(
    IN _role INT,
    IN _name VARCHAR(64),
    IN _email VARCHAR(150),
    IN _password VARCHAR(255)
)
BEGIN
    DECLARE id_user INT DEFAULT 0;
    DECLARE verify_email INT DEFAULT 0;
    DECLARE response INT DEFAULT 0;
START TRANSACTION;
    SELECT COUNT(*) INTO verify_email FROM users WHERE email = _email;
    IF verify_email > 0 THEN
        SELECT response;
    ELSE
        INSERT INTO users(name,email) VALUES(_name,_email);
        SELECT id INTO id_user FROM users WHERE email = _email;
        INSERT INTO accounts(id_role,id_user,password) VALUES(_role,id_user,_password);
        SET response = 1;
        SELECT response;
    END IF;
COMMIT;
END $$;
DELIMITER ;