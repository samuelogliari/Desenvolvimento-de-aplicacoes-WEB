<?php

require_once __DIR__ . '/../dao/Ovos.dao.php';

class OvosController
{
  public function listar()
  {
    $dao = new OvosDao();
    return $dao->listar();
  }

  public function salvar()
  {
    $ovo = new Ovos(
      $_POST['tipo_criacao'],
      $_POST['cor_casca'],
      $_POST['tamanho'],
      $_POST['preco_unitario']
    );
  
    $dao = new OvosDao();
    $dao->salvar($ovo);
    header("Location: ovos.php");
  }
  
}