<?php
ob_start(); 
require_once '../config/Conexao.php';
require_once '../models/Contato.php';
require_once '../controller/ContatoController.php';

$contatoController = new ContatoController();
$resultado = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : null;
    $valor = isset($_POST["valor"]) ? $_POST["valor"] : null;

    error_log("Tipo de pesquisa: $tipo");
    error_log("Valor de pesquisa: $valor");

    try {
        if ($tipo === "todos") {
            $resultado = $contatoController->pesquisarTodos();
        } elseif ($tipo === "id" && $valor) {
            $resultado = $contatoController->pesquisarPorId($valor);
        } elseif ($tipo === "IdPessoa" && $valor) {
            $resultado = $contatoController->pesquisarPorIdPessoa($valor);
        } else {
            $resultado = ["error" => "Tipo ou valor inválido"];
        }
    } catch (Exception $e) {
        $resultado = ["error" => $e->getMessage()];
    }

    header('Content-Type: application/json');
    echo json_encode($resultado);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["acao"]) && $_GET["acao"] === "excluir") {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    if ($id) {
        $contatoController->deletar($id);
    }
    header('Location: ../views/Contatos.php');
}
ob_end_flush();
?>
