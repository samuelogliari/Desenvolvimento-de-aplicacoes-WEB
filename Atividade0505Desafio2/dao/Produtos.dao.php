<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Produtos.model.php';

class ProdutosDao
{
  private $tabela = 'produtos';
  private $connection;

  public function __construct()
  {
    $db = new Database();
    $this->connection = $db->connection;
  }

  public function salvar(Produtos $produto)
  {
    $sql = "INSERT INTO $this->tabela (idbarras, descricao, preco) VALUES (?, ?, ?)";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([
      $produto->getIdBarras(),
      $produto->getDescricao(),
      $produto->getPreco()
    ]);
  }

  public function listar()
  {
    $sql = "SELECT * FROM $this->tabela";
    $stmt = $this->connection->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $produtos = [];
    foreach ($rows as $row) {
      $produtos[] = new Produtos(
        $row['idbarras'],
        $row['descricao'],
        $row['preco'],
        $row['id']
      );
    }
    return $produtos;
  }
}
