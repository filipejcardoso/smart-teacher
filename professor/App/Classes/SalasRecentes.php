<?php

namespace App\Classes;

class SalasRecentes
{
    private $id;
    private $descricao;
    private $data;
    private $alunos;
    private $media;
    private $maior_nota;
    private $menor_nota;
	
    public function getId(){
        return $this->id;
    }
    public function getDescricao(){
        return $this->descricao;
    }
    public function getData(){
        return $this->data;
    }
    public function getAlunos(){
        return $this->alunos;
    }
    public function getMedia(){
        return $this->media;
    }
    public function getMaiorNota(){
        return $this->maior_nota;
    }
    public function getMenorNota(){
        return $this->menor_nota;
    }

    public function setId($value){
        $this->id = $value;
    }
    public function setDescricao($value){
        $this->descricao = $value;
    }
    public function setData($value){
        $this->data = $value;
    }
    public function setAlunos($value){
        $this->alunos = $value;
    }
    public function setMedia($value){
        $this->media = $value;
    }
    public function setMaiorNota($value){
        $this->maior_nota = $value;
    }
    public function setMenorNota($value){
        $this->menor_nota = $value;
    }


}

