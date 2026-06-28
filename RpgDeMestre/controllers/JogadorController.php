<?php

require_once __DIR__ . '/../dao/JogadorDAO.php'; //importa jogadores DAO, para usar new JogadorDao();

class JogadorController //cria um controller, recebe ações, controla fluxos, DAO, conecta sistema, controla como o nome ja fiz.
{
  public function listar() //metodo listar, busca jogador no banco, cria objeto DAO
  {
    $dao = new JogadorDao();
    return $dao->listar(); //chama o $dao->listar(), e executa o select from jogadores do DAO
  }// após select, ele retorna para quem chamou o controller

  public function salvar() //salva no banco
  {
    if (strlen($_POST['nome']) > 100) { //validação de nome se tem menos de 100, com alert e history.back() para voltar a pagina anterior
      echo "<script>
            alert('O nome pode ter no máximo 100 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { //validação de email se tem menos de 100, com alert e history.back() para voltar a pagina anterior, validação email
      echo "<script> 
            alert('E-mail inválido.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['cep']) > 10) { //validação de cep se tem menos de 10, com alert e history.back() para voltar a pagina anterior
      echo "<script>
            alert('CEP inválido.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['rua']) > 100) { //validação de rua se tem menos de 100, com alert e history.back() para voltar a pagina anterior
      echo "<script>
            alert('A rua pode ter no máximo 100 caracteres.');
            history.back();
          </script>";
      exit;
    }
    if (trim($_POST['nome']) == "") {
      echo "<script>
            alert('Informe o nome do Jogador.');
            history.back();
          </script>";
      exit;
    }
    if (trim($_POST['email']) == "") {
      echo "<script>
            alert('Informe o email do Jogador.');
            history.back();
          </script>";
      exit;
    }
    if (trim($_POST['cep']) == "") {
      echo "<script>
            alert('Informe o cep do Jogador.');
            history.back();
          </script>";
      exit;
    }
    if (trim($_POST['rua']) == "") {
      echo "<script>
            alert('Informe a rua do Jogador.');
            history.back();
          </script>";
      exit;
    }


    $jogador = new Jogador( //cria um objeto do model, pega dados crus e cria objeto organizado
      $_POST['nome'], //pega dado enviado pelo formulario (site)
      $_POST['email'],
      $_POST['cep'],
      $_POST['rua'],
      $_POST['bairro'],
      $_POST['cidade'],
      $_POST['id']
    );

    $dao = new JogadorDAO(); //cria dao
    $dao->salvar($jogador);

    echo "<script>
        alert('Jogador cadastrado com sucesso!');
        window.location.href='jogadores.php';
      </script>";
    exit;
  }


  // Busca um único jogador pelo id para pré-preencher o formulário de edição
  public function buscarPorId($id)
  {
    $dao = new JogadorDAO();
    return $dao->buscarPorId($id);
  }


  // Ação de atualização: lê o POST, atualiza no banco e redireciona
  public function atualizar()
  {
    if (strlen($_POST['nome']) > 100) { //validação de nome se tem menos de 100, com alert e history.back() para voltar a pagina anterior
      echo "<script>
            alert('O nome pode ter no máximo 100 caracteres.');
            history.back();
          </script>";
      exit;
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { //validação de email se tem menos de 100, com alert e history.back() para voltar a pagina anterior, validação email
      echo "<script> 
            alert('E-mail inválido.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['cep']) > 10) { //validação de cep se tem menos de 10, com alert e history.back() para voltar a pagina anterior
      echo "<script>
            alert('CEP inválido.');
            history.back();
          </script>";
      exit;
    }

    if (strlen($_POST['rua']) > 100) { //validação de rua se tem menos de 100, com alert e history.back() para voltar a pagina anterior
      echo "<script>
            alert('A rua pode ter no máximo 100 caracteres.');
            history.back();
          </script>";
      exit;
    }


    if (trim($_POST['nome']) == "") {
      echo "<script>
            alert('Informe o nome do Jogador.');
            history.back();
          </script>";
      exit;
    }
    if (trim($_POST['email']) == "") {
      echo "<script>
            alert('Informe o email do Jogador.');
            history.back();
          </script>";
      exit;
    }
    if (trim($_POST['cep']) == "") {
      echo "<script>
            alert('Informe o cep do Jogador.');
            history.back();
          </script>";
      exit;
    }
    if (trim($_POST['rua']) == "") {
      echo "<script>
            alert('Informe a rua do Jogador.');
            history.back();
          </script>";
      exit;
    }

    $jogador = new Jogador(
      $_POST['nome'], //pega dado enviado pelo formulario (site)
      $_POST['email'],
      $_POST['cep'],
      $_POST['rua'],
      $_POST['bairro'],
      $_POST['cidade'],
      $_POST['id']
    );


    $dao = new JogadorDAO();
    $dao->atualizar($jogador);

    echo "<script>
            alert('Jogador atualizado com sucesso!');
            window.location.href='jogadores.php';
          </script>";
    exit;
  }


  // Ação de deleção: lê o POST, remove do banco e redireciona
  public function deletar()
  {
    $dao = new JogadorDAO();
    $dao->deletar($_POST['id']);

    //excluindo mensagem
    echo "<script> 
            alert('Jogador excluído com sucesso!');
            window.location.href='jogadores.php';
          </script>";
    exit;
  }

}