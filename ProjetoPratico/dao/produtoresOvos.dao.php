<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/ProdutoresOvos.models.php';

class ProdutoresOvosDao
{
  private $tabela = 'produtoresovos';
  private $connection;

  public function __construct()
  {
    $db = new Database();
    $this->connection = $db->connection;
  }

  public function salvar(ProdutoresOvos $produtor)
  {
    $sql = "INSERT INTO $this->tabela (nome, email, telefone, cnpj, ativo) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([
      $produtor->getNome(),
      $produtor->getEmail(),
      $produtor->getTelefone(),
      $produtor->getCnpj(),
      $produtor->isAtivo()

    ]);
  }

  public function listar()
  {
    $sql = "SELECT * FROM $this->tabela";
    $stmt = $this->connection->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $produtores = [];
    foreach ($rows as $row) {
      $produtores[] = new ProdutoresOvos(
        $row['nome'],
        $row['email'],
        $row['telefone'],
        $row['cnpj'],
        $row['ativo'],
        $row['id']
      );
    }
    return $produtores;
  }
}