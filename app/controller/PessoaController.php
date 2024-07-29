<?php

require_once '../config/Conexao.php';
require_once '../models/Pessoa.php';

class PessoaController {
    private $conn;

    public function __construct() {
        $this->conn = (new Conexao())->connect();
        if (!$this->conn) {
            throw new Exception('Falha na conexão com o banco de dados.');
        }
    }

    public function inserir(Pessoa $pessoa) {
        $query = 'INSERT INTO pessoa (nome, cpf) VALUES (:nome, :cpf)';
        $stmt = $this->conn->prepare($query);

        $nome = $pessoa->getNome();
        $cpf = $pessoa->getCpf();

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return null; 
    }

    public function deletar($id) {
        $query = 'DELETE FROM pessoa WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
        }
        return null; 
    }

    public function atualizar(Pessoa $pessoa) {
    
        if ($pessoa->getId() <= 0 || empty($pessoa->getNome()) || empty($pessoa->getCpf())) {
            return "Dados inválidos para atualização.";
        }

        $query = 'UPDATE pessoa SET nome = :nome, cpf = :cpf WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $nome = $pessoa->getNome();
        $cpf = $pessoa->getCpf();
        $id = $pessoa->getId();

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "Pessoa atualizada com sucesso.";
        } else {
            return "Erro ao atualizar pessoa.";
        }
    }

    public function pesquisar($tipo, $valor) {
        if ($tipo == 'id') {
            return $this->pesquisarPorId($valor);
        } else if ($tipo == 'nome') {
            return $this->pesquisarPorNome($valor);
        } else if ($tipo == 'todos') {
            return $this->pesquisarTodos();
        }
        return [];
    }

    public function pesquisarTodos() {
        $query = 'SELECT * FROM pessoa';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        error_log("Resultados da pesquisa: " . print_r($result, true));
        
        return $result;
    }

    public function pesquisarPorId($id) {
        $query = 'SELECT * FROM pessoa WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pesquisarPorNome($nome) {
        $query = 'SELECT * FROM pessoa WHERE nome LIKE :nome';
        $stmt = $this->conn->prepare($query);
        $nome = "%" . $nome . "%";
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

