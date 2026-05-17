<?php

class ProdutoresOvos
{
  private $id;
  private $nome;
  private $email;
  private $telefone;
  private $cnpj;
  private $ativo;

  public function __construct($nome, $email, $telefone, $cnpj, $ativo, $id = null)
  {
    $this->nome = $nome;
    $this->email = $email;
    $this->telefone = $telefone;
    $this->cnpj = $cnpj;
    $this->ativo = $ativo;
    $this->id = $id;
  }


  public function getId()
  {
    return $this->id;

  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function getNome()
  {
    return $this->nome;
  }
  public function setNome($nome)
  {
    $this->nome = $nome;
  }
  public function getEmail()
  {
    return $this->email;
  }
  public function setEmail($email)
  {
    $this->email = $email;
  }
  public function getTelefone()
  {
    return $this->telefone;
  }
  public function setTelefone($telefone)
  {
    $this->telefone = $telefone;
  }
  public function getCnpj()
  {
    return $this->cnpj;
  }
  public function setCnpj($cnpj)
  {
    $this->cnpj = $cnpj;
  }
  public function isAtivo()
  {
    return $this->ativo;
  }
  public function setAtivo($ativo)
  {
    $this->ativo = $ativo;
  }

}