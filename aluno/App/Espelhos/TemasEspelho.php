<?php

namespace App\Espelhos;

class TemasEspelho
{
	private $id;
    private $disciplina;
    private $descricao;
	
    public function getId(){
        return $this->id;
    }
    public function getDisciplina(){
        return $this->disciplina;
    }
    public function getDescricao(){
        return $this->descricao;
    }

    public function setId($value){
        $this->id = $value;
    }
    public function setDisciplina($value){
        $this->disciplina = $value;
    }
    public function setDescricao($value){
        $this->descricao = $value;
    }

}

