<?php

class Funcionarios
{
  private $id;
  private $dt_nascimento;
  private $nome;
  private $salario;

  public function __construct($dt_nascimento, $nome, $salario, $id = null)
  {
    $this->dt_nascimento = $dt_nascimento;
    $this->nome = $nome;
    $this->salario = $salario;
    $this->id = $id;
  }

  public function getId()
  {
    return $this->id;
  }
  public function getDtNascimento()
  {
    return $this->dt_nascimento;
  }
  public function getNome()
  {
    return $this->nome;
  }
  public function getSalario()
  {
    return $this->salario;
  }
}
