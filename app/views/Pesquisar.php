<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa</title>
    <link rel="stylesheet" href="pesquisa.css">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            updateInputField();
        });

        function pesquisarPessoa() {
            const form = document.getElementById('form-pesquisa-pessoa');
            const formData = new FormData(form);

            fetch('../controller/process_pessoa.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    const resultadosTabela = document.getElementById('resultados-tabela-pessoa');
                    resultadosTabela.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(item => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                            <td>${item.id}</td>
                            <td>${item.nome}</td>
                            <td>${item.cpf}</td>
                            <td><a class="excluir-link" href="../controller/process_pessoa.php?acao=excluir&id=${item.id}">Excluir</a>
                            <a class="excluir-link" href="../views/Atualizar.php?acao=alterar&id=${item.id}">Alterar</a></td>
                        `;
                            resultadosTabela.appendChild(row);
                        });
                    } else {
                        resultadosTabela.innerHTML = '<tr><td colspan="4">Nenhum resultado encontrado.</td></tr>';
                    }
                })
                .catch(error => console.error('Erro:', error));
        }

        function updateInputField() {
            const tipoSelect = document.getElementById('tipo');
            const inputDiv = document.getElementById('input-div');

            if (tipoSelect.value === 'id' || tipoSelect.value === 'nome') {
                inputDiv.innerHTML = '<input type="text" name="valor" placeholder="Digite o valor">';
            } else {
                inputDiv.innerHTML = '';
                pesquisarPessoa();
            }
        }
    </script>
</head>

<body>

    <div class="formulario-pesquisa-pessoa">
        <h1 class="titulo-painel">Pesquisa Pessoas</h1>
        <form id="form-pesquisa-pessoa" method="post" action="../controller/process_pessoa.php">
            <label for="tipo">Modo de pesquisa</label>
            <select name="tipo" id="tipo" onchange="updateInputField()">
                <option value="todos">Todos</option>
                <option value="id">ID</option>
                <option value="nome">Nome</option>
            </select>
            <div id="input-div"></div>
            <button type="button" onclick="pesquisarPessoa()">Pesquisar</button>
            <a href="../../index.php"><button type="button" class="botao-voltar">Voltar</button></a>
        </form>
    </div>

    <h1 class="titulo-painel">Atualizar Contato</h1>

    <div id="resultados-pessoa">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="resultados-tabela-pessoa">
            </tbody>
        </table>
    </div>
</body>

</html>