<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Ovos.models.php';

class OvosDao
{
  private $tabela = 'ovos';
  private $connection;

  public function __construct()
  {
    $db = new Database();
    $this->connection = $db->connection;
  }

  public function salvar(Ovos $ovo)
  {

    $sql = "INSERT INTO $this->tabela (tipo_criacao, cor_casca, tamanho, preco_unitario) VALUES (?, ?, ?, ?)";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([
      $ovo->getTipoCriacao(),
      $ovo->getCorCasca(),
      $ovo->getTamanho(),
      $ovo->getPrecoUnitario()
    ]);
  }


  public function listar()
  {
    $sql = "SELECT * FROM $this->tabela";
    $stmt = $this->connection->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $ovos = [];
    foreach ($rows as $row) {
      $ovos[] = new Ovos(
        $row['tipo_criacao'],
        $row['cor_casca'],
        $row['tamanho'],
        $row['preco_unitario'],
        $row['id']
      );
    }
    return $ovos;
  }
}