<?php

require_once __DIR__ . '/../dao/ProdutoresOvos.dao.php';

class ProdutoresOvosController
{
  public function listar()
  {
    $dao = new ProdutoresOvosDao();
    return $dao->listar();
  }

  public function salvar()
  {
    $produtor = new ProdutoresOvos(
      $_POST['nome'],
      $_POST['email'],
      $_POST['telefone'],
      $_POST['cnpj'],
      isset($_POST['ativo']) ? 1 : 0
    );

    $dao = new ProdutoresOvosDao();
    $dao->salvar($produtor);
    header("Location: produtoresOvos.php");
  }
}