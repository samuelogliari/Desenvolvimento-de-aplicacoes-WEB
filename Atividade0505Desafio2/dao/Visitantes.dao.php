<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Visitantes.model.php';

class VisitantesDao
{
  private $tabela = 'visitantes';
  private $connection;

  public function __construct()
  {
    $db = new Database();
    $this->connection = $db->connection;
  }

  public function salvar(Visitantes $visitante)
  {
    $sql = "INSERT INTO $this->tabela (nome, cpf) VALUES (?, ?)";
    $stmt = $this->connection->prepare($sql);

    $stmt->execute([$visitante->getNome(), $visitante->getCpf()]);
  }


  public function listar()
  {
    $sql = "SELECT * FROM $this->tabela";
    $stmt = $this->connection->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $visitantes = [];

    foreach ($rows as $row) {

      $visitantes[] = new Visitantes(
        $row['nome'],
        $row['cpf'],
        $row['id']
      );
    }

    return $visitantes;
  }
}