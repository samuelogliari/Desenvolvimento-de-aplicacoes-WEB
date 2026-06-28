<?php

require_once __DIR__ . '/../config/Database.php';         //traz esse arquivo, importa
require_once __DIR__ . '/../models/Item.php';      //traz esse arquivo, importa
//Dir é o diretorio atual do arquivo:
class ItemDao                                             //cria a classe responsável por acessar a table itens
{
  private $tabela = 'itens';                               //cria o atributo privado com valor itens, utiliza novamente no select * from itens, para facilitar
  private $connection;                                    // ira guardar a conexão PDO (extensão de ling para BD)

  public function __construct()                           //automatiza quando criar uma "$dao = new jogadorDao();"
  {
    $db = new Database();                                                 //cria objeto Database
    $this->connection = $db->connection;                                  //pega atributo connection do $db, na classe Database
    // guarda dentro do DAO, basicamente pega conexão da Database para usar depois
  }

  public function salvar(Item $item)                                     //logicamente pega tudo, e da o insert, se for compativel com a lógica.
  {
    //$this->tabela, no caso, por conta da info que chegou a cima, viraria jogadores.
    $sql = "INSERT INTO $this->tabela (nome, tipo, raridade, valor, personagem_id) VALUES (?, ?, ?, ?, ?)"; //// Usa ? como parâmetro para evitar SQL Injection
    $stmt = $this->connection->prepare($sql);                                                             //pega conexão com PDO, prepara a query e o stmt guarda statement
    $stmt->execute([                                                                                      //executa a query usando os valores a baixo, no caso, que foram retornados pelo get (models)
      $item->getNome(),
      $item->getTipo(),
      $item->getRaridade(),
      $item->getValor(),
      $item->getPersonagemId()
    ]);
  }


  public function listar() //listar que comporta puxar o nome inves do id
  {
    $sql = " SELECT i.*, p.nome AS personagem_nome 
FROM itens i
INNER JOIN personagens p ON i.personagem_id = p.id";

    $stmt = $this->connection->query($sql);           //usa query, porque nao tem parametros e é algo mais simples(não precisa preparar)
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);        //faz o PDO retornar corretamente, o fetch_assoc, faz vir os valores inves de indices numericos

    $itens = [];
    foreach ($rows as $row) {                        //foreach $rows as $row significa para cada linah retornada do banco
      $itens[] = new Item(               //transforma linhas do banco em objetos mesmo, [] adiciona ao array
        $row['nome'],                                 //pega valor da linha sql
        $row['tipo'],
        $row['raridade'],
        $row['valor'],
        $row['personagem_id'],
        $row['id'],
        $row['personagem_nome']
      );
    }
    return $itens;
  }

  // Busca um único jogador pelo seu id; retorna null se não encontrado
  public function buscarPorId($id)
  {
    $sql = "SELECT * FROM $this->tabela WHERE id = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row)
      return null;

    return new Item(
      $row['nome'],
      $row['tipo'],
      $row['raridade'],
      $row['valor'],
      $row['personagem_id'],
      $row['id']
    );
  }


  // Atualiza os dados de um já existente no banco
  public function atualizar(Item $itens)
  {
    $sql = "UPDATE $this->tabela SET nome = ?, tipo = ?, raridade = ?, valor = ?, personagem_id = ? WHERE id = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([
      $itens->getNome(),
      $itens->getTipo(),
      $itens->getRaridade(),
      $itens->getValor(),
      $itens->getPersonagemId(),
      $itens->getId()
    ]);
  }

  // Remove um jogador pelo id
  public function deletar($id)
  {
    $sql = "DELETE FROM $this->tabela WHERE id = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([$id]);
  }
}