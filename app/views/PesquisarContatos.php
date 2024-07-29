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

            fetch('../controller/process_contato.php', {
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
                            <td>${item.pessoaid}</td>
                            <td>${item.tipo}</td>
                            <td>${item.descricao}</td>
                            <td>
                                <a class="excluir-link" href="../controller/process_contato.php?acao=excluir&id=${item.id}">Excluir</a>
                                <a class="excluir-link" href="../views/AtualizarContato.php?acao=alterar&id=${item.id}">Alterar</a>
                            </td>
                        `;
                            resultadosTabela.appendChild(row);
                        });
                    } else {
                        resultadosTabela.innerHTML = '<tr><td colspan="5">Nenhum resultado encontrado.</td></tr>';
                    }
                })
                .catch(error => console.error('Erro:', error));
        }

        function updateInputField() {
            const tipoSelect = document.getElementById('tipo');
            const inputDiv = document.getElementById('input-div');

            if (tipoSelect.value === 'id' || tipoSelect.value === 'IdPessoa') {
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
        <h1 class="titulo-painel">Pesquisa Contatos</h1>
        <form id="form-pesquisa-pessoa" method="post" action="../controller/process_contato.php">
            <label for="tipo">Modo de pesquisa</label>
            <select name="tipo" id="tipo" onchange="updateInputField()">
                <option value="todos">Todos</option>
                <option value="id">ID</option>
                <option value="IdPessoa">IdPessoa</option>
            </select>
            <div id="input-div"></div>
            <button type="button" onclick="pesquisarPessoa()">Pesquisar</button>
            <a href="../../index.php"><button type="button" class="botao-voltar">Voltar</button></a>
        </form>
    </div>



    <div id="resultados-pessoa">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>IdPessoa</th>
                    <th>Tipo</th>
                    <th>Descricao</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="resultados-tabela-pessoa">
            </tbody>
        </table>
    </div>
</body>

</html>