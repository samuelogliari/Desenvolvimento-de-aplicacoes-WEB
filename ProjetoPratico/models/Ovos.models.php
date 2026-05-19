<?php

class Ovos                                   //cria o molde
{
  private $id;                               //cria as "variaveis" privadas que só podem ser utilizadas dentor desse molde
  private $tipo_criacao;
  private $cor_casca;
  private $tamanho;
  private $preco_unitario;

  //automatiza o processo de atribuir informações às variaveis
  public function __construct($tipo_criacao, $cor_casca, $tamanho, $preco_unitario, $id = null)
  {
    $this->tipo_criacao = $tipo_criacao;
    $this->cor_casca = $cor_casca;
    $this->tamanho = $tamanho;
    $this->preco_unitario = $preco_unitario;
    $this->id = $id;
  }

  //Pega a informação e retorna 
  public function getId()
  {
    return $this->id;
  }
  public function getTipoCriacao()
  {
    return $this->tipo_criacao;
  }
  public function getCorCasca()
  {
    return $this->cor_casca;
  }
  public function getTamanho()
  {
    return $this->tamanho;
  }
  public function getPrecoUnitario()
  {
    return $this->preco_unitario;
  }
}

