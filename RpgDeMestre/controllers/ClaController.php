<?php

require_once __DIR__ . '/../dao/ClaDAO.php'; //importa clas DAO, para usar new ClaDao();

class ClaController //cria um controller, recebe ações, controla fluxos, DAO, conecta sistema, controla como o nome ja fiz.
{
  public function listar() //metodo listar, busca cla no banco, cria objeto DAO
  {
    $dao = new ClaDao();
    return $dao->listar(); //chama o $dao->listar(), e executa o select from clas do DAO
  }// após select, ele retorna para quem chamou o controller

  public function salvar() //salva no banco
  {
    if (trim($_POST['nome']) == "") {
      echo "<script>
            alert('Informe o nome do clã.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['nome']) > 100) {
      echo "<script>
            alert('O nome do clã pode ter no máximo 100 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (trim($_POST['lider']) == "") {
      echo "<script>
            alert('Informe o líder do clã.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['lider']) > 100) {
      echo "<script>
            alert('O líder pode ter no máximo 100 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['regiao']) > 100) {
      echo "<script>
            alert('A região pode ter no máximo 100 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['descricao']) > 255) {
      echo "<script>
            alert('A descrição pode ter no máximo 255 caracteres.');
            history.back();
          </script>";
      exit;
    }

    $cla = new Cla( //cria um objeto do model, pega dados crus e cria objeto organizado
      $_POST['nome'], //pega dado enviado pelo formulario (site)
      $_POST['lider'],
      $_POST['regiao'],
      $_POST['descricao'],
      $_POST['id']
    );

    $dao = new ClaDAO(); //cria dao
    $dao->salvar($cla); //conecta tudo
    echo "<script>
            alert('Clã cadastrado com sucesso.');
            window.location.href='clas.php';
          </script>";
    exit;
  }


  // Busca um único jogador pelo id para pré-preencher o formulário de edição
  public function buscarPorId($id)
  {
    $dao = new ClaDAO();
    return $dao->buscarPorId($id);
  }


  // Ação de atualização: lê o POST, atualiza no banco e redireciona
  public function atualizar()
  {

    if (trim($_POST['nome']) == "") {
      echo "<script>
            alert('Informe o nome do clã.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['nome']) > 100) {
      echo "<script>
            alert('O nome do clã pode ter no máximo 100 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (trim($_POST['lider']) == "") {
      echo "<script>
            alert('Informe o líder do clã.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['lider']) > 100) {
      echo "<script>
            alert('O líder pode ter no máximo 100 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['regiao']) > 100) {
      echo "<script>
            alert('A região pode ter no máximo 100 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['descricao']) > 255) {
      echo "<script>
            alert('A descrição pode ter no máximo 255 caracteres.');
            history.back();
          </script>";
      exit;
    }


    $cla = new Cla(
      $_POST['nome'], //pega dado enviado pelo formulario (site)
      $_POST['lider'],
      $_POST['regiao'],
      $_POST['descricao'],
      $_POST['id']
    );


    $dao = new ClaDAO();
    $dao->atualizar($cla);


    $dao->atualizar($cla);

    echo "<script>
        alert('Clã atualizado com sucesso.');
        window.location.href='clas.php';
      </script>";
    exit;
  }


  // Ação de deleção: lê o POST, remove do banco e redireciona
  public function deletar()
  {
    $dao = new ClaDAO();
    $dao->deletar($_POST['id']);


    echo "<script>
        alert('Clã excluído com sucesso!');
        window.location.href='clas.php';
      </script>";
    exit;
  }

}