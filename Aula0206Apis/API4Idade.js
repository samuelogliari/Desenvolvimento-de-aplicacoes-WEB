async function buscarDados(url, endpoint, params) {
  try {
    const response = await fetch(`${url}${endpoint}/${params}`);
    if (!response.ok) {
      throw new Error(`Erro na requisição: ${response.status}`);
    }
    const dados = await response.json();
    return dados;
  } catch (erro) {
    console.error("Houve um problema com o fetch:", erro);
    return null;
  }
}

function exibirDadosIdade(dados) {
  const resultado = document.getElementById("resultado4");

  if (!dados || dados.length === 0) {
    resultado.innerHTML = "<p>Não é possível identificar a idade.</p>";
    return;
  }

  linhas = `
      <tr>
        <td>${dados.count}</td>
        <td>${dados.name}</td>
        <td>${dados.age}</td>
      </tr>
    `;

  resultado.innerHTML = `
      <table border="1">
        <thead>
          <tr>
            <th>Count</th>
            <th>Nome</th>
            <th>Idade</th>
          </tr>
        </thead>
        <tbody>${linhas}</tbody>
      </table>
    `;
}

async function carregarIdade() {
  const nome = document.getElementById("nome3").value;

  if (!nome) {
    alert("Digite um nome.");
    return;
  }

  const dados = await buscarDados("https://api.agify.io", "/", "?name=" + nome);

  exibirDadosIdade(dados);
  return;
}
