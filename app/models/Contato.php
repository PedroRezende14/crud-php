<?php

class Contato {

    private int $id;
    private int $idPessoa;
    private string $tipo;
    private string $descricao; 

    public function setId(int $id) {
        $this->id = $id;
    }

    public function setIdPessoa(int $idPessoa) {
        $this->idPessoa = $idPessoa;
    }

    public function setTipo(string $tipo) {
        $this->tipo = $tipo;
    }

    public function setDescricao(string $descricao) {
        $this->descricao = $descricao; 
    }

    public function getId(): int {
        return $this->id;
    }

    public function getIdPessoa(): int {
        return $this->idPessoa;
    }

    public function getTipo(): string {
        return $this->tipo;
    }
    
    public function getDescricao(): string {
        return $this->descricao; 
    }
}
?>
