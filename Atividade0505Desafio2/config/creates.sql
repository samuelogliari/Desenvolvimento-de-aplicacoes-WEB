CREATE TABLE visitantes (
  id SERIAL PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  cpf CHAR(11) NOT NULL
);

CREATE TABLE produtos (
  id SERIAL PRIMARY KEY,
  idbarras CHAR(13) NOT NULL,
  descricao VARCHAR(255) NOT NULL,
  preco DECIMAL(10,2) NOT NULL
);

CREATE funcionarios (
  id SERIAL PRIMARY KEY,
  dtNascimento DATE NOT NULL,
  nome VARCHAR(255) NOT NULL,
salario DECIMAL(10,2) NOT NULL
);
