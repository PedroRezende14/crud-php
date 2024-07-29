<?php

class Pessoa {

    private int $id;
    private String $nome;
    private String $cpf;

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNome($string){
        $this->nome=$string;
    }

    public function setCpf($string){
        $this->cpf=$string;
    }

    public function getId(){
        return $this->id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getCpf(){
        return $this->cpf;
    }
}
?>