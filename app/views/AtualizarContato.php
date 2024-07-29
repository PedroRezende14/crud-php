<?php
require_once '../models/Contato.php';
require_once '../controller/ContatoController.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["tipo"]) && isset($_POST["descricao"]) && $id) {
        $contato = new Contato();
        $contato->setTipo($_POST["tipo"]);
        $contato->setDescricao($_POST["descricao"]);
        $contato->setId($id);

        $contatoController = new ContatoController();
        $contatoController->atualizar($contato);

        header('Location: ../views/PesquisarContatos.php');
        exit();
    }
}
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
            var tipo = document.getElementById('tipo').value;
            var descricao = document.getElementById('descricao').value;

            if (tipo === 'celular') {
                var telefoneRegex = /^\d{10,11}$/;
                if (!telefoneRegex.test(descricao)) {
                    alert('Por favor, insira um telefone válido. Deve conter 10 ou 11 dígitos.');
                    return false;
                }
            } else if (tipo === 'email') {
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(descricao)) {
                    alert('Por favor, insira um email válido.');
                    return false;
                }
            }

            return true; 
        }
    </script>
</head>

<body>

    <h1 class="titulo-painel">Atualizar Contato</h1>

    <div class="formulario-cadastro">
        <form action="" method="post" onsubmit="return validarFormulario()">
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo">
                <option value="celular" <?php echo (isset($_POST["tipo"]) && $_POST["tipo"] == 'celular') ? 'selected' : ''; ?>>Celular</option>
                <option value="email" <?php echo (isset($_POST["tipo"]) && $_POST["tipo"] == 'email') ? 'selected' : ''; ?>>Email</option>
            </select>

            <label for="descricao">Descrição:</label>
            <input name="descricao" id="descricao" type="text" value="<?php echo isset($_POST["descricao"]) ? htmlspecialchars($_POST["descricao"]) : ''; ?>">

            <button type="submit">Enviar</button>
        </form>
    </div>

</body>

</html>
