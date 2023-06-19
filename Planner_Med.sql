CREATE DATABASE planner_medicacao;
USE planner_medicacao;
CREATE TABLE me_tipo_usuario(
id_tipo_usuario INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(300) NOT NULL
);

CREATE TABLE me_usuario(
 id_usuario INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome_usuario VARCHAR(300) NOT NULL,
    email VARCHAR(300) NOT NULL,
    id_tipo_usuario INT NOT NULL,
    FOREIGN KEY (id_tipo_usuario) REFERENCES me_tipo_usuario(id_tipo_usuario)
);
CREATE TABLE me_login(
    login VARCHAR(200) NOT NULL,
    senha VARCHAR(200) NOT NULL,
    id_usuario INT NOT NULL,
    PRIMARY KEY(login, senha), 
    FOREIGN KEY (id_usuario) REFERENCES me_usuario(id_usuario)
);
CREATE TABLE me_dependente(
    id_dependente INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome_dependente VARCHAR(200) NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES me_usuario(id_usuario)
);
CREATE TABLE me_medicamento(
    id_medicamento INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome_medicamento VARCHAR(300) NOT NULL,
    fabricante VARCHAR(300) NOT NULL,
    bula TEXT NOT NULL
);
CREATE TABLE me_horario(
 id_horario INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  horario DATETIME NOT NULL,
  login VARCHAR(50) NOT NULL,
  id_medicamento INT NOT NULL,
  dosagem VARCHAR(100) NOT NULL,
  concentracao VARCHAR(100) NOT NULL,
  FOREIGN KEY (login) REFERENCES me_login(login),
  FOREIGN KEY (id_medicamento) REFERENCES me_medicamento(id_medicamento)
);
CREATE TABLE me_registro(
    id_registro INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    horario_registro DATETIME NOT NULL,
    id_medicamento INT NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_medicamento) REFERENCES me_medicamento(id_medicamento),
    FOREIGN KEY (id_usuario) REFERENCES me_usuario(id_usuario)
);

INSERT INTO me_tipo_usuario(id_tipo_usuario, nome)
VALUES(null, 'usuario comum');
INSERT INTO me_tipo_usuario(id_tipo_usuario, nome)
VALUES(null, 'dependente');
INSERT into  me_usuario(id_usuario,nome_usuario,email,id_tipo_usuario)
VALUES(null,'patreze','p13leal@hotmail.com',1);
insert into me_login(login,senha,id_usuario)
VALUES('patreze','1234',1);
select *from me_login;
select *from me_usuario;
select *from me_dependente;

select *from me_horario;
