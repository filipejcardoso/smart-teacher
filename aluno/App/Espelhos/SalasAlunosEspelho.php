<?php

namespace App\Espelhos;

class SalasAlunosEspelho
{
	private $id;
    private $sala;
    private $nome;
    private $ra;
    private $turma;
    private $tempo_termino;
    private $nota_final;
    private $status;
	
    public function getId(){
        return $this->id;
    }
    public function getSala(){
        return $this->sala;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getRa(){
        return $this->ra;
    }
    public function getTurma(){
        return $this->turma;
    }
    public function getTempoTermino(){
        return $this->tempo_termino;
    }
    public function getNotaFinal(){
        return $this->nota_final;
    }
    public function getStatus(){
        return $this->status;
    }

    public function setId($value){
        $this->id = $value;
    }
    public function setSala($value){
        $this->sala = $value;
    }
    public function setNome($value){
        $this->nome = $value;
    }
    public function setRa($value){
        $this->ra = $value;
    }
    public function setTurma($value){
        $this->turma = $value;
    }
    public function setTempoTermino($value){
        $this->tempo_termino = $value;
    }
    public function setNotaFinal($value){
        $this->nota_final = $value;
    }
    public function setStatus($value){
        $this->status = $value;
    }

}

