<?php

class Produtos
{
  private $id;
  private $idbarras;
  private $descricao;
  private $preco;

  public function __construct($idbarras, $descricao, $preco, $id = null)
  {
    $this->idbarras = $idbarras;
    $this->descricao = $descricao;
    $this->preco = $preco;
    $this->id = $id;
  }

  public function getId()
  {
    return $this->id;
  }
  public function getIdBarras()
  {
    return $this->idbarras;
  }
  public function getDescricao()
  {
    return $this->descricao;
  }
  public function getPreco()
  {
    return $this->preco;
  }
}
