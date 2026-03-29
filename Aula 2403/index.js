const resultado = document.getElementById("numero");
resultado.innerText = "0";
main();
tecladoNumerico();

function adicionaNumeroCalc(numero) {
  if (resultado.innerText == 0) {
    resultado.innerText = "";
  }
  if (resultado.innerText.length !== 33) {
    resultado.innerText += numero;
  }
}

function apagar() {
  if (resultado.innerText.length == 1) {
    resultado.innerText = "0";
  } else {
    resultado.innerText = resultado.innerText.slice(
      0,
      resultado.innerText.length - 1,
    );
  }
}

function adicionaSinalCalc(sinal) {
  if (
    resultado.innerText.slice(-1) == "+" ||
    resultado.innerText.slice(-1) == "-" ||
    resultado.innerText.slice(-1) == "/" ||
    resultado.innerText.slice(-1) == "*"
  ) {
    resultado.innerText = resultado.innerText.slice(0, -1);
  }
  resultado.innerText += sinal;
}
function calcular(evento) {
  console.log(evento);
  if (evento.key == "Enter") {
    try {
      resultado.innerText = eval(resultado.innerText);
      if (!Number.isFinite(Number(resultado.innerText))) {
        resultado.innerText = "0";
        window.alert("Não é possível dividir por 0.");
      }
    } catch (error) {
      console.log("Ocorreu um erro", error);
    }
  }
  if (resultado.innerText == "69"){
    resultado.innerText = "Tu é laele";
  }
  if (resultado.innerText == "24"){
    resultado.innerText = "Roveda radiante no Valorant, e dia do veado"
  }
  if (resultado.innerText == "13"){
    resultado.innerText = "Aniversário do Gabriel e PT"
  }
}
function main() {
  document.addEventListener("keydown", function (evento) {
    evento.preventDefault();
    calcular(evento);
  });
}
function tecladoNumerico() {
  document.addEventListener("keydown", function (evento) {
    if (!isNaN(evento.key)) {
      adicionaNumeroCalc(evento.key);
    }
    if (
      evento.key == "/" ||
      evento.key == "+" ||
      evento.key == "-" ||
      evento.key == "*"
    ) {
      adicionaSinalCalc(evento.key);
    }
    if (evento.key == "Backspace"){
      apagar();
    }
  });
}
