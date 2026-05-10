<?php

require_once __DIR__ . '/../dao/Visitantes.dao.php'; // carrega o DAO (que já carrega Database e Model)

// Controller: orquestra a comunicação entre o DAO e as Views
class VisitantesController
{
  // Retorna todos os visitantes buscados do banco
  public function listar()
  {
    $dao = new VisitantesDao();
    return $dao->listar();
  }

  // Ação de cadastro: lê o POST, salva no banco e redireciona
  public function salvar()
  {
    // Cria o objeto com os dados enviados pelo formulário via POST
    $visitante = new Visitantes(
      $_POST['nome'],         // nome do visitante
      $_POST['cpf']           // CPF do visitante
    );

    $dao = new VisitantesDao(); // instancia o DAO
    $dao->salvar($visitante);  // salva o objeto no banco


  }
}