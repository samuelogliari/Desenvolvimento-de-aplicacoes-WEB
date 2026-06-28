<?php

require_once __DIR__ . '/../dao/ItemDAO.php'; //importa itens DAO, para usar new ItemDao();
require_once __DIR__ . '/../models/Item.php';
class ItemController //cria um controller, recebe ações, controla fluxos, DAO, conecta sistema, controla como o nome ja fiz.
{
  public function listar() //metodo listar, busca item no banco, cria objeto DAO
  {
    $dao = new ItemDao();
    return $dao->listar(); //chama o $dao->listar(), e executa o select from itens do DAO
  }// após select, ele retorna para quem chamou o controller

  public function salvar() //salva no banco
  {
    if (trim($_POST['nome']) == "") {
      echo "<script>
            alert('Informe o nome do item.');
            history.back();
          </script>";
      exit;
    }
    if (trim($_POST['tipo']) == "") {
      echo "<script>
            alert('Informe o tipo do item.');
            history.back();
          </script>";
      exit;
    }
    if (trim($_POST['raridade']) == "") {
      echo "<script>
            alert('Informe a raridade do item.');
            history.back();
          </script>";
      exit;
    }
    if (strlen($_POST['nome']) > 100) { //validação de nome se tem menos de 100, com alert e history.back() para voltar a pagina anterior
      echo "<script>
            alert('O nome pode ter no máximo 100 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['tipo']) > 50) {
      echo "<script> 
            alert('O tipo pode ter no máximo 50 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (!is_numeric($_POST['valor']) || $_POST['valor'] < 0) { //validação de valor
      echo "<script>
            alert('Valor inválido. Deve ser um número positivo.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['raridade']) > 50) {
      echo "<script>
            alert('A raridade pode ter no máximo 50 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (empty($_POST['personagem_id'])) {
      echo "<script>
            alert('Selecione um personagem.');
            history.back();
          </script>";
      exit;
    }
    if (trim($_POST['valor']) == "") {
      echo "<script>
            alert('Informe o valor do item.');
            history.back();
          </script>";
      exit;
    }

    $item = new Item( //cria um objeto do model, pega dados crus e cria objeto organizado
      $_POST['nome'], //pega dado enviado pelo formulario (site)
      $_POST['tipo'],
      $_POST['raridade'],
      $_POST['valor'],
      $_POST['personagem_id']
    );

    $dao = new ItemDAO(); //cria dao
    $dao->salvar($item);

    echo "<script>
        alert('Item cadastrado com sucesso!');
        window.location.href='itens.php';
      </script>";
    exit;
  }

  // Busca um único item pelo id para pré-preencher o formulário de edição
  public function buscarPorId($id)
  {
    $dao = new ItemDao();
    return $dao->buscarPorId($id);
  }

  // le o POST, atualiza no banco e redireciona
  public function atualizar()
  {
    if (trim($_POST['nome']) == "") {
      echo "<script>
            alert('Informe o nome do item.');
            history.back();
          </script>";
      exit;
    }
    if (trim($_POST['tipo']) == "") {
      echo "<script>
            alert('Informe o tipo do item.');
            history.back();
          </script>";
      exit;
    }
    if (trim($_POST['raridade']) == "") {
      echo "<script>
            alert('Informe a raridade do item.');
            history.back();
          </script>";
      exit;
    }
    if (strlen($_POST['nome']) > 100) { //validação de nome se tem menos de 100, com alert e history.back() para voltar a pagina anterior
      echo "<script>
            alert('O nome pode ter no máximo 100 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['tipo']) > 50) {
      echo "<script> 
            alert('O tipo pode ter no máximo 50 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (!is_numeric($_POST['valor']) || $_POST['valor'] < 0) { //validação de valor
      echo "<script>
            alert('Valor inválido. Deve ser um número positivo.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['raridade']) > 50) {
      echo "<script>
            alert('A raridade pode ter no máximo 50 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (empty($_POST['personagem_id'])) {
      echo "<script>
            alert('Selecione um personagem.');
            history.back();
          </script>";
      exit;
    }
    if (trim($_POST['valor']) == "") {
      echo "<script>
            alert('Informe o valor do item.');
            history.back();
          </script>";
      exit;
    }

    $item = new Item(
      $_POST['nome'], //pega dado enviado pelo formulario (site)
      $_POST['tipo'],
      $_POST['raridade'],
      $_POST['valor'],
      $_POST['personagem_id'],
      $_POST['id']
    );


    $dao = new ItemDAO();
    $dao->atualizar($item);

    echo "<script>
            alert('Item atualizado com sucesso!');
            window.location.href='itens.php';
          </script>";
    exit;
  }


  // le o POST, remove do banco e redireciona
  public function deletar()
  {
    $dao = new ItemDao();
    $dao->deletar($_POST['id']);

    //excluindo mensagem
    echo "<script> 
            alert('Item excluído com sucesso!');
            window.location.href='itens.php';
          </script>";
    exit;
  }
}
