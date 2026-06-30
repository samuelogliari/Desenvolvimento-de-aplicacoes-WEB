<?php

require_once __DIR__ . '/../config/Database.php';         //traz esse arquivo, importa
require_once __DIR__ . '/../models/Personagem.php';      //traz esse arquivo, importa
//Dir é o diretorio atual do arquivo:
class PersonagemDao                                             //cria a classe responsável por acessar a table personagens
{
  private $tabela = 'personagens';                               //cria o atributo privado com valor personagens, utiliza novamente no select * from personagens, para facilitar
  private $connection;                                    // ira guardar a conexão PDO (extensão de ling para BD)

  public function __construct()                           //automatiza quando criar uma "$dao = new jogadorDao();"
  {
    $db = new Database();                                                 //cria objeto Database
    $this->connection = $db->connection;                                  //pega atributo connection do $db, na classe Database
    // guarda dentro do DAO, basicamente pega conexão da Database para usar depois
  }

  public function salvar(Personagem $personagens)                                     //logicamente pega tudo, e da o insert, se for compativel com a lógica.
  {
    //$this->tabela, no caso, por conta da info que chegou a cima, viraria jogadores.
    $sql = "INSERT INTO $this->tabela (nome, classe, nivel, especialidade, jogador_id, cla_id) VALUES (?, ?, ?, ?, ?, ?)"; //// Usa ? como parâmetro para evitar SQL Injection
    $stmt = $this->connection->prepare($sql);                                                             //pega conexão com PDO, prepara a query e o stmt guarda statement
    $stmt->execute([                                                                                      //executa a query usando os valores a baixo, no caso, que foram retornados pelo get (models)
      $personagens->getNome(),
      $personagens->getClasse(),
      $personagens->getNivel(),
      $personagens->getEspecialidade(),
      $personagens->getJogadorId(),
      $personagens->getClaId()
    ]);
  }


  public function listar() //listar que comporta puxar o nome inves do id
  {
    $sql = " SELECT p.*, j.nome AS jogador_nome, c.nome AS cla_nome 
            FROM personagens p
        INNER JOIN jogadores j ON p.jogador_id = j.id
        INNER JOIN clas c ON p.cla_id = c.id";

    $stmt = $this->connection->query($sql);           //usa query, porque nao tem parametros e é algo mais simples(não precisa preparar)
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);        //faz o PDO retornar corretamente, o fetch_assoc, faz vir os valores inves de indices numericos

    $personagens = [];
    foreach ($rows as $row) {                        //foreach $rows as $row significa para cada linah retornada do banco
      $personagens[] = new Personagem(               //transforma linhas do banco em objetos mesmo, [] adiciona ao array
        $row['nome'],                                 //pega valor da linha sql
        $row['classe'],
        $row['nivel'],
        $row['especialidade'],
        $row['jogador_id'],
        $row['cla_id'],
        $row['id'],
        $row['jogador_nome'],
        $row['cla_nome']
      );
    }
    return $personagens;
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


    return new Personagem(
      $row['nome'],
      $row['classe'],
      $row['nivel'],
      $row['especialidade'],
      $row['jogador_id'],
      $row['cla_id'],
      $row['id']
    );
  }


  // Atualiza os dados de um já existente no banco
  public function atualizar(Personagem $personagens)
  {
    $sql = "UPDATE $this->tabela SET nome = ?, classe = ?, nivel = ?, especialidade = ?, jogador_id = ?, cla_id = ? WHERE id = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([
      $personagens->getNome(),
      $personagens->getClasse(),
      $personagens->getNivel(),
      $personagens->getEspecialidade(),
      $personagens->getJogadorId(),
      $personagens->getClaId(),
      $personagens->getId()
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