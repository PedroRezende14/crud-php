<?php
ob_start();

require_once '../models/Pessoa.php';
require_once 'PessoaController.php';
require_once 'ContatoController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome"]) && isset($_POST["cpf"])) {
        $pessoa = new Pessoa();
        $pessoa->setNome($_POST["nome"]);
        $pessoa->setCpf($_POST["cpf"]);

        $pessoaController = new PessoaController();
        $pessoaId = $pessoaController->inserir($pessoa);

        if ($pessoaId && !empty($_POST["tipo"]) && !empty($_POST["descricao"])) {
            $contatoController = new ContatoController();

            foreach ($_POST["tipo"] as $index => $tipo) {
                if (!empty($tipo) && !empty($_POST["descricao"][$index])) {
                    $contato = new Contato();
                    $contato->setIdPessoa($pessoaId);
                    $contato->setTipo($tipo);
                    $contato->setDescricao($_POST["descricao"][$index]);
                    $contatoController->inserir($contato);
                }
            }
        }
        header('Location: ../views/Cadastro.php');
        exit;
    }
}

ob_end_flush();
?>
