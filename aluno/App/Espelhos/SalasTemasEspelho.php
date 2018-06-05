<?php

namespace App\Espelhos;

class SalasTemasEspelho
{
	private $id;
    private $sala;
    private $tema;
    private $quantidade;
	
    public function getId(){
        return $this->id;
    }
    public function getSala(){
        return $this->sala;
    }
    public function getTema(){
        return $this->tema;
    }
    public function getQuantidade(){
        return $this->quantidade;
    }

    public function setId($value){
        $this->id = $value;
    }
    public function setSala($value){
        $this->sala = $value;
    }
    public function setTema($value){
        $this->tema = $value;
    }
    public function setQuantidade($value){
        $this->quantidade = $value;
    }

}

