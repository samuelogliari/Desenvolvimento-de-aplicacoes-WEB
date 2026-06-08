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

function exibirDadosNacionalidade(dados) {
  const resultado = document.getElementById("resultado3");

  if (!dados || dados.length === 0) {
    resultado.innerHTML = "<p>Nenhum país encontrado.</p>";
    return;
  }

  const linhas = dados.country
    .map(
      (dados) => `
      <tr>
        <td>${dados.country_id}</td>
        <td>${dados.probability * 100}%</td>
      </tr>
    `,
    )

    .join("");

  resultado.innerHTML = `
      <table border="1">
      ${dados.count}
      ${dados.name}
        <thead>
          <tr>
            <th>País</th>
            <th>Probabilidade</th>
          </tr>
        </thead>
        <tbody>${linhas}</tbody>
      </table>
    `;
}

async function carregarNacionalidade() {
  const nome = document.getElementById("nome2").value;

  if (!nome) {
    alert("Digite um nome.");
    return;
  }

  const dados = await buscarDados(
    "https://api.nationalize.io",
    "/",
    "?name=" + nome,
  );

  exibirDadosNacionalidade(dados);
  return;
}
