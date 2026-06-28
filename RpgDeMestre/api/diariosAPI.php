<?php
header('Content-Type: application/json');

$arquivo = __DIR__ . '/diarios.json'; //banco falso para simul.

if (!file_exists($arquivo)) { //garante existência do arquivo
  file_put_contents($arquivo, json_encode([]));
}

$diarios = json_decode(file_get_contents($arquivo), true); //le os dados exist.

//get para listar
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  echo json_encode($diarios);
  exit;
}

//post para salvar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $input = json_decode(file_get_contents("php://input"), true);

  if (!isset($input['titulo']) || !isset($input['conteudo'])) {
    echo json_encode(["erro" => true, "mensagem" => "Campos obrigatórios: título e conteúdo"]);
    exit;
  }


  $novo = [
    "id" => time(), //gera id único
    "titulo" => $input['titulo'],
    "conteudo" => $input['conteudo'],
    "data" => date("Y-m-d")
  ];

  $diarios[] = $novo;
  file_put_contents($arquivo, json_encode($diarios, JSON_PRETTY_PRINT));

  echo json_encode([
    "mensagem" => "Diário salvo com sucesso",
    "diario" => $novo
  ]);
  exit;
}

echo json_encode(["erro" => true, "mensagem" => "método não suportado"]);
