<?php

require_once '../config/Conexao.php';

class ContatoController{
    private $conn;

    public function __construct(){
        $this->conn=(new Conexao())->connect();
    }

    public function inserir($tipo, $descricao, $pessoaid){
        $query = 'INSERT INTO contatos (tipo, descricao, pessoaid) VALUES (:tipo, :descricao, :pessoaid)';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam('pessoaid', $pessoaid);

        if($stmt->execute()){
            echo "Pessoa inserida";
        }
    }

    public function deletar($id){
        $query = 'DELETE FROM contatos WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo "Pessoa deletada";
        } 
    }

    public function pesquisarTodos() {
        $query = 'SELECT * FROM contatos';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pesquisarPorId($id){
        $query = 'SELECT * FROM contatos WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $tipo, $descricao, $pessoaid) {
       
        $query = 'UPDATE contatos SET tipo = :tipo, descricao = :descricao, pessoaid = :pessoaid WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':pessoaid', $pessoaid, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return 'Contato atualizado com sucesso.';
        } else {
            return 'Erro ao atualizar contato.';
        }
    }
}

// Exemplo de uso
$controll = new ContatoController();

// Inserir um novo contato
// echo $controll->inserir('email', 'asasa', 1);

// Deletar um contato
// echo $controll->deletar(1);

// Pesquisar todos os contatos
// $contatos = $controll->pesquisarTodos();
// print_r($contatos);

// Pesquisar contato por ID
// $contato = $controll->pesquisarPorId(1);
// print_r($contato);

// Atualizar um contato
echo $controll->atualizar(4, 'phone', '11', 1);

?>