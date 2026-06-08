async function buscarDadosFeriado(url, endpoint, params) {
  try {
    console.log(`${url}/${endpoint}/${params}`);
    const response = await fetch(`${url}/${endpoint}/${params}`);
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

function exibirDadosFeriados(dados) {
  const resultado = document.getElementById("resultado");

  if (!dados || dados.length === 0) {
    resultado.innerHTML = "<p>Nenhum feriado encontrado.</p>";
    return;
  }

  const linhas = dados
    .map(
      (feriado) => `
      <tr>
        <td>${feriado.date}</td>
        <td>${feriado.name}</td>
        <td>${feriado.type}</td>
        <td>${feriado.weekday}</td>
      </tr>
    `,
    )
    .join("");

  resultado.innerHTML = `
      <table border="1">
        <thead>
          <tr>
            <th>Data</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Dia da semana</th>
          </tr>
        </thead>
        <tbody>${linhas}</tbody>
      </table>
    `;
}

async function carregarFeriados() {
  const ano = document.getElementById("ano").value;

  if (!ano) {
    alert("Digite um ano.");
    return;
  }
  console.log(ano);
  const dados = await buscarDadosFeriado(
    "https://brasilapi.com.br/api",
    "feriados/v1",
    ano,
  );

  exibirDadosFeriados(dados);
  return;
}
