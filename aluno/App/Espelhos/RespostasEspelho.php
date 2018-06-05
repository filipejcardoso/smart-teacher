<?php

namespace App\Espelhos;

class RespostasEspelho
{
	private $id;
    private $questao;
    private $texto;
    private $correta;
	
    public function getId(){
        return $this->id;
    }
    public function getQuestao(){
        return $this->questao;
    }
    public function getTexto(){
        return $this->texto;
    }
    public function getCorreta(){
        return $this->correta;
    }

    public function setId($value){
        $this->id = $value;
    }
    public function setQuestao($value){
        $this->questao = $value;
    }
    public function setTexto($value){
        $this->texto = $value;
    }
    public function setCorreta($value){
        $this->correta = $value;
    }

}

