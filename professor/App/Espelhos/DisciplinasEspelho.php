<?php

namespace App\Espelhos;

class DisciplinasEspelho
{
	private $id;
    private $professor;
    private $descricao;
	
    public function getId(){
        return $this->id;
    }
    public function getProfessor(){
        return $this->professor;
    }
    public function getDescricao(){
        return $this->descricao;
    }

    public function setId($value){
        $this->id = $value;
    }
    public function setProfessor($value){
        $this->professor = $value;
    }
    public function setDescricao($value){
        $this->descricao = $value;
    }

}

