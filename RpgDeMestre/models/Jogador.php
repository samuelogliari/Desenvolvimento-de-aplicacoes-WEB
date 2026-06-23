<?php

class Jogador
{

    private $id;
    private $nome;
    private $email;
    private $cep;
    private $rua;
    private $bairro;
    private $cidade;

    public function __construct($nome, $email, $cep, $rua, $bairro, $cidade, $id = null)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->cep = $cep;
        $this->rua = $rua;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
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

    public function getEmail()
    {
        return $this->email;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function getRua()
    {
        return $this->rua;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

}