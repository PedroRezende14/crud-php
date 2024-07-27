<?php

require_once '../config/Conexao.php';

class PessoaController{
    private $conn;

    public function __construct(){
        $this->conn = (new Conexao())->connect();
    }

    public function inserir($nome, $cpf){
        $query = 'INSERT INTO pessoa (nome, cpf) VALUES (:nome, :cpf)';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome',$nome);
        $stmt->bindParam(':cpf',$cpf);

        if($stmt->execute()){
            echo "Pessoa inserida";
        }
    }

    public function deletar($id) {
        $query = 'DELETE FROM pessoa WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo "Pessoa deletada";
        } 
    }

    public function atualizar($id, $nome, $cpf) {
        $query = 'UPDATE pessoa SET nome = :nome, cpf = :cpf WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);

        if ($stmt->execute()) {
            echo "Pessoa atualizada";
        } 
    }

    public function pesquisarTodos() {
        $query = 'SELECT * FROM pessoa';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pesquisarPorId($id){
        $query = 'SELECT * FROM pessoa WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

$controller = new PessoaController();

// echo $controller->inserir('João Silvavas', '1111a1');
// echo $controller->inserir('João Silvva', '11111a1');

// echo $controller->deletar(4);

// $pessoa = $controller->pesquisarTodos();
// print_r($pessoa);

// echo $controller->atualizar(4, 'gleiton', '2000');

?>

