<?php
ob_start();
require_once '../models/Pessoa.php';
require_once '../controller/PessoaController.php';
require_once '../models/Contato.php';
require_once '../controller/ContatoController.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome"]) && isset($_POST["cpf"])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($id) {

            $pessoa = new Pessoa();
            $pessoa->setNome($_POST["nome"]);
            $pessoa->setCpf($_POST["cpf"]);
            $pessoa->setId($id);

            $pessoaController = new PessoaController();
            $pessoaController->atualizar($pessoa);

            header('Location: PesquisarPessoa.php');
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
    <script>
        function validarFormulario() {
            var cpf = document.getElementById('cpf').value;
            cpf = cpf.replace(/[^\d]+/g, '');
            if (cpf.length !== 11) {
                alert('Por favor, insira um CPF válido com 11 dígitos.');
                return false;
            }
            return true; 
        }
    </script>
</head>

<body>

    <h1 class="titulo-painel">Atualizar Pessoa</h1>

    <div class="formulario-cadastro">
        <form action="" method="post" onsubmit="return validarFormulario()">

            <label for="nome">Nome:</label>
            <input name="nome" id="nome" type="text" required>

            <label for="cpf">CPF:</label>
            <input name="cpf" id="cpf" type="text" required >

            <button type="submit">Enviar</button>

        </form>
    </div>

</body>

</html>
