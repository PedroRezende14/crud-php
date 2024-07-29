<?php
ob_start();
require_once '../models/Contato.php';
require_once '../controller/ContatoController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["tipo"]) && isset($_POST["descricao"]) && isset($_POST["idPessoa"])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($id) {
            $contato = new Contato();
            $contato->setTipo($_POST["tipo"]);
            $contato->setDescricao($_POST["descricao"]);
            $contato->setIdPessoa($_POST["idPessoa"]);
            $contato->setId($id);

            $contatoController = new ContatoController();
            $contatoController->atualizar($contato);
            header('Location: ../views/Contatos.php');
            exit();
        }
    }
}
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <link rel="stylesheet" href="styler.css">
</head>

<body>

    <h1 class="titulo-painel">Atualizar Contato</h1>

    <div class="formulario-cadastro">
        <form action="" method="post">

            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo">
                <option value="celular">Celular</option>
                <option value="email">Email</option>
            </select>

            <label for="descricao">Descrição:</label>
            <input name="descricao" id="descricao" type="text">

            <label for="idPessoa">Id Pessoa:</label>
            <input name="idPessoa" id="idPessoa" type="number">

            <button type="submit">Enviar</button>

        </form>
    </div>

</body>

</html>