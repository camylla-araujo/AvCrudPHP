CREATE DATABASE db_escola;

USE db_escola;

CREATE TABLE tb_alunos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    matricula VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    status TINYINT NOT NULL,
    genero VARCHAR(20) NOT NULL,
    dataNascimento DATETIME NOT NULL,
    cpf CHAR(11) UNIQUE NOT NULL
);

CREATE TABLE tb_professores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    endereco VARCHAR(45) NOT NULL,
    formacao VARCHAR(45) NOT NULL,
    status TINYINT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    cpf CHAR(11) UNIQUE NOT NULL
);


CREATE TABLE tb_user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    profile VARCHAR(20) NOT NULL
);

INSERT INTO tb_alunos 
(nome, matricula, email, status, genero, dataNascimento, cpf)
VALUES
('Camylla', '1234567', 'camylla@email.com', true, 'Feminino', '2000-02-08', '12312312312'),
('Talyson', '4434123', 'chatao@email.com', true, 'Masculino', '2001-02-28', '45645645645'),
('XeroVerde', '5534123', 'xero@email.com', true, 'Não informado', '1997-06-27', '78978978978'),
('Carlos', '5234123', 'carlos@email.com', true, 'Masculino', '1995-04-27', '10110110110'),
('Nevile', '5334123', 'nevile@email.com', true, 'Masculino', '1994-06-25', '10210210210'),
('Diene', '5434123', 'diene@email.com', true, 'Feminino', '1997-06-27', '10310310310');

SELECT * FROM tb_alunos;

INSERT INTO tb_professores
(nome, endereco, formacao, status, cpf)
VALUES
('Alessandro','Rua cachaca velha 123', 'HTML, CSS, JS, React', true, '66666666666'),
('Allan','Rua idelfonso albano 222, ap 1403', 'SABE TUDO, BRABISSIMO', true, '99999999999'),
('Gleidson', 'Rua cheiro do queijo 88', 'Formado nas ruas', true, '22222222222'),
('Abraao', 'Rua limao verde 88', 'Formado nas ruas', true, '33333333333');

CREATE TABLE tb_categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL
);

CREATE TABLE tb_cursos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    cargaHoraria VARCHAR(50) NOT NULL,
    descricao VARCHAR(100) UNIQUE NOT NULL,
    status TINYINT NOT NULL,
    categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES tb_categorias(id)
);

INSERT INTO tb_categorias (nome) 
VALUES 
('Profissionalizante'),
('Tecnico'),
('Graduação'),
('Extensão'),
('Pós Graduação');

INSERT INTO tb_cursos
(nome, cargaHoraria, descricao, status, categoria_id)
VALUES
('FullStack','192','Vai ficar profissional',1,1);

SELECT * FROM tb_cursos INNER JOIN tb_categorias ON tb_cursos.categoria_id = tb_categorias.id;