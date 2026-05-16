<?php

// Responsável por criar e fornecer a conexão com o banco de dados
class Database
{
  public $connection; // conexão PDO acessada pelo DAO

  public function __construct()
  {
    $host = "localhost";
    $porta = "4777";
    $database = "webDB";
    $usuario = "postgres";
    $senha = "postgres";

    $dsn = "pgsql:host=$host;port=$porta;dbname=$database";

    $this->connection = new PDO($dsn, $usuario, $senha);
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}