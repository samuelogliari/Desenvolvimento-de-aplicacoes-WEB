<?php

// Carrega o .env apenas se as variáveis ainda não estiverem no ambiente.
if (!getenv('DB_HOST')) { //procura variavel no amb, no nosso caso DB_HOST=localhost na .env, e retorna só localhost
// como tem o ! a lógica é "Se não existir a variavel DB_HOST, logo, só le o .env 1 vez
    $linhas = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
// o file ignore new lines, basicamente faz as infos não virem com \n da quebra de linha
//  e o skip empty ignora linhas vazias

    foreach ($linhas as $linha) { //percorre array
        if (str_starts_with(trim($linha), '#')) continue; //trim remove espaços,
// pula linha q começa com #
        [$chave, $valor] = explode('=', $linha, 2); //explode - divide texto tirando o =,
        //$chave e valor guarda separado p exemplo, chave = DB_PASS e o valor a senha mesmo.
        putenv(trim($chave) . '=' . trim($valor)); //putenv cria variavel de ambiente, com isso,
        // pode ser feito o "getenv("DB_HOST")" em qualquer lugar, porfim trim remove espaços antes e depois da chave e valor
    }
}