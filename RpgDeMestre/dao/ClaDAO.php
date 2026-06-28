<?php

require_once __DIR__ . '/../config/Database.php';         //traz esse arquivo, importa
require_once __DIR__ . '/../models/Cla.php';      //traz esse arquivo, importa
//Dir é o diretorio atual do arquivo:
class ClaDAO                                             //cria a classe responsável por acessar a table clas
{
  private $tabela = 'clas';                               //cria o atributo privado com valor clas, utiliza novamente no select * from clas, para facilitar
  private $connection;                                    // ira guardar a conexão PDO (extensão de ling para BD)

  public function __construct()                           //automatiza quando criar uma "$dao = new claDao();"
  {
    $db = new Database();                                                 //cria objeto Database
    $this->connection = $db->connection;                                  //pega atributo connection do $db, na classe Database
    // guarda dentro do DAO, basicamente pega conexão da Database para usar depois
  }

  public function salvar(Cla $clas)                                     //logicamente pega tudo, e da o insert, se for compativel com a lógica.
  {
    //$this->tabela, no caso, por conta da info que chegou a cima, viraria clas.
    $sql = "INSERT INTO $this->tabela (nome, lider, regiao, descricao) VALUES (?, ?, ?, ?)"; //// Usa ? como parâmetro para evitar SQL Injection
    $stmt = $this->connection->prepare($sql);                                                             //pega conexão com PDO, prepara a query e o stmt guarda statement
    $stmt->execute([                                                                                      //executa a query usando os valores a baixo, no caso, que foram retornados pelo get (models)
      $clas->getNome(),
      $clas->getLider(),
      $clas->getRegiao(),
      $clas->getDescricao()
    ]);
  }


  public function listar()
  {
    $sql = "SELECT * FROM $this->tabela";
    $stmt = $this->connection->query($sql);           //usa query, porque nao tem parametros e é algo mais simples(não precisa preparar)
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);        //faz o PDO retornar corretamente, o fetch_assoc, faz vir os valores inves de indices numericos

    $clas = [];
    foreach ($rows as $row) {       //foreach $rows as $row significa para cada linah retornada do banco
      $clas[] = new Cla(           //transforma linhas do banco em objetos mesmo, [] adiciona ao array
        $row['nome'],             //pega valor da linha sql
        $row['lider'],
        $row['regiao'],
        $row['descricao'],
        $row['id']
      );
    }
    return $clas;
  }

  // Busca um único cla pelo seu id; retorna null se não encontrado
  public function buscarPorId($id)
  {
    $sql = "SELECT * FROM $this->tabela WHERE id = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row)
      return null;

    return new Cla(
      $row['nome'],
      $row['lider'],
      $row['regiao'],
      $row['descricao'],
      $row['id']
    );
  }


  // Atualiza os dados de um já existente no banco
  public function atualizar(Cla $clas)
  {
    $sql = "UPDATE $this->tabela SET nome = ?, lider = ?, regiao = ?, descricao = ? WHERE id = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([
      $clas->getNome(),
      $clas->getLider(),
      $clas->getRegiao(),
      $clas->getDescricao(),
      $clas->getId()
    ]);
  }


  // Remove um cla pelo id
  public function deletar($id)
  {
    $sql = "DELETE FROM $this->tabela WHERE id = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([$id]);
  }



}