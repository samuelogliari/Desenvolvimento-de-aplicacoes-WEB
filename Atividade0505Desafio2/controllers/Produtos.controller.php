<?php

require_once __DIR__ . '/../dao/Produtos.dao.php';

class ProdutosController
{
  public function listar()
  {
    $dao = new ProdutosDao();
    return $dao->listar();
  }

  public function salvar()
  {
    $produto = new Produtos(
      $_POST['idbarras'],
      $_POST['descricao'],
      $_POST['preco']
    );
    $dao = new ProdutosDao();
    $dao->salvar($produto);
    header("Location: produtos.php");
  }
}
