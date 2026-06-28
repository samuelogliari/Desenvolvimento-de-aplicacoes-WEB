<?php

class Personagem
{
  private $id;
  private $nome;
  private $classe;
  private $nivel;
  private $especialidade;
  private $jogador_id;
  private $cla_id;
  private $jogador_nome;
  private $cla_nome;

  public function __construct($nome, $classe, $nivel, $especialidade, $jogador_id, $cla_id, $id = null, $jogador_nome = null, $cla_nome = null)
  {
    $this->id = $id;
    $this->nome = $nome;
    $this->classe = $classe;
    $this->nivel = $nivel;
    $this->especialidade = $especialidade;
    $this->jogador_id = $jogador_id;
    $this->cla_id = $cla_id;
    $this->jogador_nome = $jogador_nome;
    $this->cla_nome = $cla_nome;
  }


  public function getId()
  {
    return $this->id;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function getClasse()
  {
    return $this->classe;
  }

  public function getNivel()
  {
    return $this->nivel;
  }

  public function getEspecialidade()
  {
    return $this->especialidade;
  }

  public function getJogadorId()
  {
    return $this->jogador_id;
  }

  public function getClaId()
  {
    return $this->cla_id;
  }
  public function getJogadorNome()
  {
    return $this->jogador_nome;
  }

  public function getClaNome()
  {
    return $this->cla_nome;
  }

}