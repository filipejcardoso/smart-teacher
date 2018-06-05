<?php

namespace App\Espelhos;

class QuestoesEspelho
{
	private $id;
    private $tema;
    private $descricao;
    private $dificuldade;
	
    public function getId(){
        return $this->id;
    }
    public function getTema(){
        return $this->tema;
    }
    public function getDescricao(){
        return $this->descricao;
    }
    public function getDificuldade(){
        return $this->dificuldade;
    }

    public function setId($value){
        $this->id = $value;
    }
    public function setTema($value){
        $this->tema = $value;
    }
    public function setDescricao($value){
        $this->descricao = $value;
    }
    public function setDificuldade($value){
        $this->dificuldade = $value;
    }

}

