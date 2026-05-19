<?php

require_once __DIR__ . '/../dao/Ovos.dao.php'; //importa ovos DAO, para usar new OvosDao();

class OvosController //cria um controller, recebe ações, controla fluxos, DAO, conecta sistema, controla como o nome ja fiz.
{
  public function listar() //metodo listar, busca ovos no banco, cria objeto DAO
  {
    $dao = new OvosDao();
    return $dao->listar(); //chama o $dao->listar(), e executa o select from ovos do DAO
  }// após select, ele retorna para quem chamou o controller

  public function salvar() //salva no banco
  {
    $ovo = new Ovos( //cria um objeto do model, pega dados crus e cria objeto organizado
      $_POST['tipo_criacao'], //pega dado enviado pelo formulario (site)
      $_POST['cor_casca'],
      $_POST['tamanho'],
      $_POST['preco_unitario']
    );
  
    $dao = new OvosDao(); //cria dao
    $dao->salvar($ovo); //conecta tudo
    header("Location: ovos.php"); //redireciona navegador, para poder reenviar formulario, funcionario fica na mesma página após enviar
  }
  
}