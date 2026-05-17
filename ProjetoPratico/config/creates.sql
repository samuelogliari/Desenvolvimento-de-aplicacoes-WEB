CREATE TABLE ovo (
  id SERIAL PRIMARY KEY,
  tipo_criacao VARCHAR(50) NOT NULL,
  cor_casca VARCHAR(50) NOT NULL,
  tamanho VARCHAR(50) NOT NULL,
  preco_unitario DECIMAL(10, 2) NOT NULL
);

CREATE TABLE produtoresovos (
  id SERIAL PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  telefone CHAR(11) NOT NULL,
  cnpj CHAR(14) NOT NULL,
  ativo BOOLEAN NOT NULL
);