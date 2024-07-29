<?php

require_once '../config/Conexao.php';
require_once '../models/Contato.php';

class ContatoController {
    private $conn;

    public function __construct() {
        $this->conn = (new Conexao())->connect();
    }

    public function inserir(Contato $contato) {
        $query = 'INSERT INTO contatos (tipo, descricao, pessoaid) VALUES (:tipo, :descricao, :pessoaid)';
        $stmt = $this->conn->prepare($query);

        $tipo = $contato->getTipo();
        $descricao = $contato->getDescricao();
        $pessoaid = $contato->getIdPessoa();

        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':pessoaid', $pessoaid);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deletar($id) {
        $query = 'DELETE FROM contatos WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo "Contato deletado";
        }
    }

    public function pesquisarTodos() {
        $query = 'SELECT * FROM contatos';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pesquisarPorIdPessoa($idPessoa) {
        $query = 'SELECT * FROM contatos WHERE pessoaid = :idPessoa';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idPessoa', $idPessoa);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pesquisarPorId($id) {
        $query = 'SELECT * FROM contatos WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizar(Contato $contato) {
        $query = 'UPDATE contatos SET tipo = :tipo, descricao = :descricao, pessoaid = :pessoaid WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $tipo = $contato->getTipo();
        $descricao = $contato->getDescricao();
        $pessoaid = $contato->getIdPessoa();
        $id = $contato->getId();

        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':pessoaid', $pessoaid);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return 'Contato atualizado com sucesso.';
        } else {
            return 'Erro ao atualizar contato.';
        }
    }
}
?>
