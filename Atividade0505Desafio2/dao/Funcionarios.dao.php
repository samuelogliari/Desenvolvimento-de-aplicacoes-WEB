<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Funcionarios.model.php';

class FuncionariosDao
{
  private $tabela = 'funcionarios';
  private $connection;

  public function __construct()
  {
    $db = new Database();
    $this->connection = $db->connection;
  }

  public function salvar(Funcionarios $funcionario)
  {
    $sql = "INSERT INTO $this->tabela (dt_nascimento, nome, salario) VALUES (?, ?, ?)";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([
      $funcionario->getDtNascimento(),
      $funcionario->getNome(),
      $funcionario->getSalario()
    ]);
  }

  public function listar()
  {
    $sql = "SELECT * FROM $this->tabela";
    $stmt = $this->connection->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $funcionarios = [];
    foreach ($rows as $row) {
      $funcionarios[] = new Funcionarios(
        $row['dt_nascimento'],
        $row['nome'],
        $row['salario'],
        $row['id']
      );
    }
    return $funcionarios;
  }
}
