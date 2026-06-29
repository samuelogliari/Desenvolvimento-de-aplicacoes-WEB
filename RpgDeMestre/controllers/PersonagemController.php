<?php

require_once __DIR__ . '/../dao/PersonagemDAO.php'; //importa personagens DAO, para usar new PersonagemDao();

class PersonagemController //cria um controller, recebe ações, controla fluxos, DAO, conecta sistema, controla como o nome ja fiz.
{
  public function listar() //metodo listar, busca personagem no banco, cria objeto DAO
  {
    $dao = new PersonagemDao();
    return $dao->listar(); //chama o $dao->listar(), e executa o select from personagens do DAO
  }// após select, ele retorna para quem chamou o controller

  public function salvar() //salva no banco
  {
    if (trim($_POST['nome']) == "") {
      echo "<script>
            alert('Informe o nome do personagem.');
            history.back();
          </script>";
      exit;
    }
    if (trim($_POST['classe']) == "") {
      echo "<script>
            alert('Informe a classe do personagem.');
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

    if (strlen($_POST['classe']) > 50) {
      echo "<script> 
            alert('A classe pode ter no máximo 50 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (!is_numeric($_POST['nivel']) || $_POST['nivel'] < 1 || $_POST['nivel'] > 100) { //validação de nível
      echo "<script>
            alert('Nível inválido. Deve estar entre 1 e 100.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['especialidade']) > 100) {
      echo "<script>
            alert('A especialidade pode ter no máximo 100 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (empty($_POST['jogador_id'])) {
      echo "<script>
            alert('Selecione um jogador.');
            history.back();
          </script>";
      exit;
    }

    if (empty($_POST['cla_id'])) {
      echo "<script>
            alert('Selecione um clã.');
            history.back();
          </script>";
      exit;
    }


    $personagem = new Personagem( //cria um objeto do model, pega dados crus e cria objeto organizado
      $_POST['nome'], //pega dado enviado pelo formulario (site)
      $_POST['classe'],
      $_POST['nivel'],
      $_POST['especialidade'],
      $_POST['jogador_id'],
      $_POST['cla_id']
    );

    $dao = new PersonagemDAO(); //cria dao
    $dao->salvar($personagem);

    echo "<script>
        alert('Personagem cadastrado com sucesso!');
        window.location.href='personagens.php';
      </script>";
    exit;
  }


  // Busca um único personagem pelo id para pré-preencher o formulário de edição
  public function buscarPorId($id)
  {
    $dao = new PersonagemDAO();
    return $dao->buscarPorId($id);
  }


  // le o POST, atualiza no banco e redireciona
  public function atualizar()
  {
    if (trim($_POST['nome']) == "") {
      echo "<script>
            alert('Informe o nome do personagem.');
            history.back();
          </script>";
      exit;
    }
    if (trim($_POST['classe']) == "") {
      echo "<script>
            alert('Informe a classe do personagem.');
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

    if (strlen($_POST['classe']) > 50) {
      echo "<script> 
            alert('A classe pode ter no máximo 50 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (!is_numeric($_POST['nivel']) || $_POST['nivel'] < 1 || $_POST['nivel'] > 100) { //validação de nível
      echo "<script>
            alert('Nível inválido. Deve estar entre 1 e 100.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['especialidade']) > 100) {
      echo "<script>
            alert('A especialidade pode ter no máximo 100 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (empty($_POST['jogador_id'])) {
      echo "<script>
            alert('Selecione um jogador.');
            history.back();
          </script>";
      exit;
    }

    if (empty($_POST['cla_id'])) {
      echo "<script>
            alert('Selecione um clã.');
            history.back();
          </script>";
      exit;
    }
    $personagem = new Personagem(
      $_POST['nome'], //pega dado enviado pelo formulario (site)
      $_POST['classe'],
      $_POST['nivel'],
      $_POST['especialidade'],
      $_POST['jogador_id'],
      $_POST['cla_id'],
      $_POST['id']
    );


    $dao = new PersonagemDAO();
    $dao->atualizar($personagem);

    echo "<script>
            alert('Personagem atualizado com sucesso!');
            window.location.href='personagens.php';
          </script>";
    exit;
  }


  // le o POST, remove do banco e redireciona
  public function deletar()
  {
    try {

      $dao = new PersonagemDao();
      $dao->deletar($_POST['id']);

      echo "<script>
            alert('Personagem excluído com sucesso!');
            window.location.href='personagens.php';
        </script>";

    } catch (PDOException $e) {

      echo "<script>
            alert('Não é possível excluir este personagem, pois existem itens vinculados a ele.');
            window.location.href='personagens.php';
        </script>";

    }

    exit;
  }
}