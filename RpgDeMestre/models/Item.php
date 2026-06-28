<?php

class Item
{
  private $id;
  private $nome;
  private $tipo;
  private $raridade;
  private $valor;
  private $personagem_id;

  private $personagem_nome;

  public function __construct($nome, $tipo, $raridade, $valor, $personagem_id, $id = null, $personagem_nome = null)
  {
    $this->id = $id;
    $this->nome = $nome;
    $this->tipo = $tipo;
    $this->raridade = $raridade;
    $this->valor = $valor;
    $this->personagem_id = $personagem_id;
    $this->personagem_nome = $personagem_nome;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function getTipo()
  {
    return $this->tipo;
  }

  public function getRaridade()
  {
    return $this->raridade;
  }

  public function getValor()
  {
    return $this->valor;
  }

  public function getPersonagemId()
  {
    return $this->personagem_id;
  }

  public function getPersonagemNome()
  {
    return $this->personagem_nome;
  }
}