<?php

class contato{

    private int $id;
    private int $idPessoa;
    private boolean $tipo;
    private String $descricao;

    public function setId($int){
        $this->id=$int;
    }

    public function setIdPessoa($int){
        $this->idPessoa=$int;
    }

    public function setTipo($boolean){
        $this->tipo->$boolean;
    }

    public function setDescricao($string){
        $this->Descricao=$string;
    }

    public function getId(){
        return $this->id;
    }

    public function getIdPessoa(){
        return $this->idPessoa;
    }

    public function getTipo(){
        return $this->Tipo;
    }

    public function getDescricao(){
        return $this->descricao;
    }
}