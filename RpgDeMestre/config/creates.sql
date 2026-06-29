CREATE TABLE jogadores (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR (100) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    rua VARCHAR(100) NOT NULL,
    bairro VARCHAR(100),
    cidade VARCHAR(100)
);

CREATE TABLE clas (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    lider VARCHAR(100) NOT NULL,
    regiao VARCHAR(100),
    descricao VARCHAR(255)
);

CREATE TABLE personagens (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    classe VARCHAR(50) NOT NULL,
    nivel INTEGER NOT NULL,
    especialidade VARCHAR(100),
    jogador_id INTEGER REFERENCES jogadores(id),
    cla_id INTEGER REFERENCES clas(id)
);

CREATE TABLE itens (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    raridade VARCHAR(50) NOT NULL,
    valor NUMERIC(10,2) NOT NULL,
    personagem_id INTEGER REFERENCES personagens(id)
);

