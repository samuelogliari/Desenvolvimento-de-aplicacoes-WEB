<?php

class Cla
{

  private $id;
  private $nome;
  private $lider;
  private $regiao;
  private $descricao;

  public function __construct($nome, $lider, $regiao, $descricao, $id = null)
  {
    $this->nome = $nome;
    $this->lider = $lider;
    $this->regiao = $regiao;
    $this->descricao = $descricao;
    $this->id = $id;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function getLider()
  {
    return $this->lider;
  }

  public function getRegiao()
  {
    return $this->regiao;
  }

  public function getDescricao()
  {
    return $this->descricao;
  }
}