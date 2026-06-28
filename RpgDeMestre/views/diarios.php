<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Diários</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <form id="formDiario" class="form">
    <div>
      <label for="titulo">Título:</label>
    </div>
    <div>
      <input type="text" id="titulo" name="titulo" required>
    </div>
    <div>
      <label for="conteudo">Conteúdo:</label>
    </div>
    <div>
      <textarea id="conteudo" name="conteudo" required></textarea>
    </div>
    <div>


      <button type="submit" class="botaoSalvar">Salvar</button>
      <button type="button" class="botaoSalvar" onclick="window.location.href='index.php'">
        Voltar
      </button>
    </div>
  </form>


  <!--lista-->

  <div class="lista">
    <h3>Lista de Diários</h3>
    <table>
      <tr>
        <td>ID</td>
        <th>Título</th>
        <th>Conteúdo</th>
        <th>Data</th>
      </tr>
      <tbody id="lista"></tbody> <!-- Os diarios serao adicionados aqui dinamicamente -->
    </table>
  </div>

  <script>
    const apiURL = "../api/diariosAPI.php";

    //LISTAR com get
    async function carregarDiarios() {
      const res = await fetch(apiURL);
      const data = await res.json();
      const tbody = document.getElementById('lista');
      tbody.innerHTML = ""; // Limpa tabela antes de adicionar os novos dados
      data.forEach(d => {
        tbody.innerHTML += `
        <tr>
        <td>${d.id}</td>
        <td>${d.titulo}</td>
        <td>${d.conteudo}</td>
        <td>${d.data}</td>
      </tr>
      `;
      });
    }

    //SALVAR com post
    document.getElementById("formDiario").addEventListener("submit", async function (e) {
      e.preventDefault();
      const titulo = document.getElementById("titulo").value;
      const conteudo = document.getElementById("conteudo").value;
      const res = await fetch(apiURL, {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({ titulo, conteudo })
      });

      const result = await res.json();
      alert(result.mensagem);
      document.getElementById("formDiario").reset();
      carregarDiarios(); //atualiza lista depois de salvar
    });
    //inicial
    carregarDiarios();
  </script>
</body>

</html>