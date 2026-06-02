<?php

// Responsável por criar e fornecer a conexão com o banco de dados
class Database //existe somente para criar a conexão PDO
{
  public $connection; // conexão PDO acessada pelo DAO
// cria atributo connection para usar a baixo
  public function __construct() //executa automaticamente $db = new Database();
  {
    $host = "localhost"; 
    $porta = "5432";
    $database = "webDB";
    $usuario = "postgres";
    $senha = "postgres";

    $dsn = "pgsql:host=$host;port=$porta;dbname=$database";
//data source name - monta a string de conexão
    $this->connection = new PDO($dsn, $usuario, $senha); //cria conexão no banco
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } // configurando comportamento do PDO, define como PDO trata erros, se der erro faça execption
} //(erros podem passar silenciosamente, bom que avise quando estiver errado)