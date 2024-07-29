<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <link rel="stylesheet" href="styler.css">
</head>
<body>

    <h1 class="titulo-painel">Painel de cadastro</h1>
    <br>
    <a href="../../index.php"><button type="button" class="botao-voltar">Voltar</button></a>


    <div class="formulario-cadastro">
        <form action="../controller/Process.php" method="post">

            <label for="nome">Nome:</label>
            <input name="nome" id="nome" type="text">

            <label for="cpf">CPF:</label>
            <input name="cpf" id="cpf" type="text">

            <div id="contatos">
                <div class="contato" id="contato-1">
                    <label for="tipo-1">Tipo:</label>
                    <select name="tipo[]" id="tipo-1">
                        <option value="celular">Celular</option>
                        <option value="email">Email</option>
                    </select>

                    <label for="descricao-1">Descrição:</label>
                    <input name="descricao[]" id="descricao-1" type="text">
                </div>
            </div>

            <button type="button" onclick="addContato()">Adicionar contato</button>
            <button type="button" onclick="removeContato()">Remover contato</button>

            <button type="submit">Enviar</button>
            
        </form>
    </div>

    <script>
        let contatoCount = 1;

        function addContato() {
            contatoCount++;
            const newContato = document.createElement('div');
            newContato.classList.add('contato');
            newContato.id = `contato-${contatoCount}`;
            newContato.innerHTML = `
                <label for="tipo-${contatoCount}">Tipo:</label>
                <select name="tipo[]" id="tipo-${contatoCount}">
                    <option value="celular">Celular</option>
                    <option value="email">Email</option>
                </select>

                <label for="descricao-${contatoCount}">Descrição:</label>
                <input name="descricao[]" id="descricao-${contatoCount}" type="text">
            `;
            document.getElementById('contatos').appendChild(newContato);
        }

        function removeContato() {
            if (contatoCount > 0) {
                const contatoToRemove = document.getElementById(`contato-${contatoCount}`);
                contatoToRemove.parentNode.removeChild(contatoToRemove);
                contatoCount--;
            }
        }
    </script>
</body>
</html>
