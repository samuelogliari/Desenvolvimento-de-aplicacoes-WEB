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

function exibirDadosGeneros(dados) {
  const resultado = document.getElementById("resultado2");

  if (!dados || dados.length === 0) {
    resultado.innerHTML = "<p>Nenhum gênero encontrado.</p>";
    return;
  }

  linhas = `
      <tr>
        <td>${dados.count}</td>
        <td>${dados.name}</td>
        <td>${dados.gender}</td>
        <td>${Number(dados.probability) * 100}%</td>
      </tr>
    `;

  resultado.innerHTML = `
      <table border="1">
        <thead>
          <tr>
            <th>Count</th>
            <th>Nome</th>
            <th>Gênero</th>
            <th>Probabilidade</th>
          </tr>
        </thead>
        <tbody>${linhas}</tbody>
      </table>
    `;
}

async function carregarGeneros() {
  const nome = document.getElementById("nome").value;

  if (!nome) {
    alert("Digite um nome.");
    return;
  }

  const dados = await buscarDados(
    "https://api.genderize.io",
    "/",
    "?name=" + nome,
  );

  exibirDadosGeneros(dados);
  return;
}
