<?php

namespace App\Espelhos;

class QuestoesTextoEspelho
{
	private $id;
    private $questao;
    private $texto;
    private $codigo;
	
    public function getId(){
        return $this->id;
    }
    public function getQuestao(){
        return $this->questao;
    }
    public function getTexto(){
        return $this->texto;
    }
    public function getCodigo(){
        return $this->codigo;
    }

    public function setId($value){
        $this->id = $value;
    }
    public function setQuestao($value){
        $this->questao = $value;
    }
    public function setCodigo($value){
        $this->codigo = $value;
    }
    public function setTexto($value){
        $this->texto = $value;
    }

}

