<?php

require_once __DIR__ . '/../dao/Funcionarios.dao.php';

class FuncionariosController
{
  public function listar()
  {
    $dao = new FuncionariosDao();
    return $dao->listar();
  }

  public function salvar()
  {
    $funcionario = new Funcionarios(
      $_POST['dtNascimento'],
      $_POST['nome'],
      $_POST['salario']
    );
    $dao = new FuncionariosDao();
    $dao->salvar($funcionario);
    header("Location: funcionarios.php");
  }
}
