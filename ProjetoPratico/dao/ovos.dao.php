<?php

require_once __DIR__ . '/../config/Database.php';         //traz esse arquivo, importa
require_once __DIR__ . '/../models/Ovos.models.php';      //traz esse arquivo, importa
                                                          //Dir é o diretorio atual do arquivo:
class OvosDao                                             //cria a classe responsável por acessar a table ovos
{
  private $tabela = 'ovos';                               //cria o atributo privado com valor ovos, utiliza novamente no select * from ovos, para facilitar
  private $connection;                                    // ira guardar a conexão PDO (extensão de ling para BD)

  public function __construct()                           //automatiza quando criar uma "$dao = new ovosDao();"
  {
    $db = new Database();                                                 //cria objeto Database
    $this->connection = $db->connection;                                  //pega atributo connection do $db, na classe Database
                                                                          // guarda dentro do DAO, basicamente pega conexão da Database para usar depois
  }

  public function salvar(Ovos $ovo)                                     //logicamente pega tudo, e da o insert, se for compativel com a lógica.
  {
                                                                        //$this->tabela, no caso, por conta da info que chegou a cima, viraria ovos.
    $sql = "INSERT INTO $this->tabela (tipo_criacao, cor_casca, tamanho, preco_unitario) VALUES (?, ?, ?, ?)"; //// Usa ? como parâmetro para evitar SQL Injection
    $stmt = $this->connection->prepare($sql);                           //pega conexão com PDO, prepara a query e o stmt guarda statement
    $stmt->execute([                                                    //executa a query usando os valores a baixo, no caso, que foram retornados pelo get (models)
      $ovo->getTipoCriacao(),
      $ovo->getCorCasca(),
      $ovo->getTamanho(),
      $ovo->getPrecoUnitario()
    ]);
  }


  public function listar() 
  {
    $sql = "SELECT * FROM $this->tabela";
    $stmt = $this->connection->query($sql);           //usa query, porque nao tem parametros e é algo mais simples(não precisa preparar)
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);        //faz o PDO retornar corretamente, o fetch_assoc, faz vir os valores inves de indices numericos

    $ovos = [];
    foreach ($rows as $row) {       //foreach $rows as $row significa para cada linah retornada do banco
      $ovos[] = new Ovos(           //transforma linhas do banco em objetos mesmo, [] adiciona ao array
        $row['tipo_criacao'],       //pega valor da linha sql
        $row['cor_casca'],
        $row['tamanho'],
        $row['preco_unitario'],
        $row['id']
      );
    }
    return $ovos;
  }



        // Busca um único ovo pelo seu id; retorna null se não encontrado
    public function buscarPorId($id)
    {
        $sql  = "SELECT * FROM $this->tabela WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);


        if (!$row) return null;


        return new Ovos(
            $row['tipo_criacao'],
            $row['cor_casca'],
            $row['tamanho'],
            $row['preco_unitario'],
            $row['id']
        );
    }


    // Atualiza os dados de um ovo já existente no banco
    public function atualizar(Ovos $ovo)
    {
        $sql  = "UPDATE $this->tabela SET tipo_criacao = ?, cor_casca = ?, tamanho = ?, preco_unitario = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            $ovo->getTipoCriacao(),
            $ovo->getCorCasca(),
            $ovo->getTamanho(),
            $ovo->getPrecoUnitario(),
            $ovo->getId()
        ]);
    }
 // Remove um ovo pelo id
    public function deletar($id)
    {
        $sql  = "DELETE FROM $this->tabela WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
    }



}