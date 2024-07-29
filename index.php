<?php
 
require_once __DIR__ . '/vendor/autoload.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="app/views/styler.css">
</head>
<body>
    <div class ="menuprincipal">
        <h1>Bem-vindo ao Sistema</h1>
        <button onclick="window.location.href='app/views/Cadastro.php'">Cadastrar</button>
        <button onclick="window.location.href='app/views/PesquisarPessoa.php'">Pesquisar Pessoas</button>
        <button onclick="window.location.href='app/views/PesquisarContatos.php'">Pesquisar Contatos</button>
    </div>
</body>
</html>
