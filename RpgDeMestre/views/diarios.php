<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Diários</title>
</head>

<body>
  <h1>Diários (Mock Api)</h1>
  <form id="formDiario">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" required>
    <br>
    <label for="conteudo">Conteúdo:</label>
    <textarea id="conteudo" name="conteudo" required></textarea>
    <br>
    <button type="submit">Salvar Diário</button>
    <br><br>
    <button type="button" onclick="window.location.href='index.php'">
      Voltar
    </button>
  </form>

  <hr>
  <!--lista-->
  <table border="1">
    <thead>
      <tr>
        <td>ID</td>
        <th>Título</th>
        <th>Conteúdo</th>
        <th>Data</th>
      </tr>
    </thead>
    <tbody id="lista"></tbody> <!-- Os diarios serao adicionados aqui dinamicamente -->
  </table>
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