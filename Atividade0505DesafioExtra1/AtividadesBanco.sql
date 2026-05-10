-- Atividade0505DesafioExtra - Criação de Tabelas
CREATE TABLE livros (
cd SERIAL PRIMARY KEY,
titulo VARCHAR(255) NOT NULL,
autor VARCHAR(255) NOT NULL,
isbn CHAR(13) NOT NULL
);

CREATE TABLE veiculos (
cd SERIAL PRIMARY KEY,
placa CHAR(8),
modelo VARCHAR(255),
marca VARCHAR(255)
);

CREATE TABLE pacientes (
cd SERIAL PRIMARY KEY,
nome VARCHAR(255) NOT NULL,
numero_prontuario CHAR(7) NOT NULL,
tipo_sanguineo CHAR(2) NOT NULL
);

CREATE TABLE eventos (
cd SERIAL PRIMARY KEY,
nome VARCHAR(255) NOT NULL,
dt DATE NOT NULL,
lc VARCHAR(255) NOT NULL
);

Create TABLE cursos (
cd SERIAL PRIMARY KEY,
nome VARCHAR(255) NOT NULL,
carga_horaria DECIMAL(5,2) NOT NULL,
categoria VARCHAR(255) NOT NULL
);

-----------------------------------------------------------------



