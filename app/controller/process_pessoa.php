<?php
ob_start();
require_once '../models/Pessoa.php';
require_once '../controller/PessoaController.php';
require_once '../models/Contato.php';
require_once '../controller/ContatoController.php';

$pessoaController = new PessoaController();
$resultado = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : null;
    $valor = isset($_POST["valor"]) ? $_POST["valor"] : null;

    error_log("Tipo de pesquisa: $tipo");
    error_log("Valor de pesquisa: $valor");

    try {
        if ($tipo === "todos") {
            $resultado = $pessoaController->pesquisarTodos();
        } elseif ($tipo && $valor) {
            $resultado = $pessoaController->pesquisar($tipo, $valor);
        } else {
            $resultado = ["error" => "Tipo ou valor inválido"];
        }
    } catch (Exception $e) {
        $resultado = ["error" => $e->getMessage()];
    }

    echo json_encode($resultado);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $pessoaController->deletar($id);

    header('Location: ../views/Pesquisar.php');
}
ob_end_flush();
?>