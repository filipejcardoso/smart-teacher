<?php

namespace App\Espelhos;

class SalasEspelho
{
	private $id;
    private $professor;
    private $disciplina;
    private $descricao;
    private $numero_questoes;
    private $incorreta;
    private $alunos_max;
    private $tempo_max;
    private $data_aplicacao;
    private $horario_inicio;
    private $horario_termino;
    private $status;
	
    public function getId(){
        return $this->id;
    }
    public function getProfessor(){
        return $this->professor;
    }
    public function getDisciplina(){
        return $this->disciplina;
    }
    public function getDescricao(){
        return $this->descricao;
    }
    public function getNumeroQuestoes(){
        return $this->numero_questoes;
    }
    public function getIncorreta(){
        return $this->incorreta;
    }
    public function getAlunosMax(){
        return $this->alunos_max;
    }
    public function getTempoMax(){
        return $this->tempo_max;
    }
    public function getDataAplicacao(){
        return $this->data_aplicacao;
    }
    public function getHorarioInicio(){
        return $this->horario_inicio;
    }
    public function getHorarioTermino(){
        return $this->horario_termino;
    }
    public function getStatus(){
        return $this->status;
    }

    public function setId($value){
        $this->id = $value;
    }
    public function setProfessor($value){
        $this->professor = $value;
    }
    public function setDisciplina($value){
        $this->disciplina = $value;
    }
    public function setDescricao($value){
        $this->descricao = $value;
    }
    public function setNumeroQuestoes($value){
        $this->numero_questoes = $value;
    }
    public function setIncorreta($value){
        $this->incorreta = $value;
    }
    public function setAlunosMax($value){
        $this->alunos_max = $value;
    }
    public function setTempoMax($value){
        $this->tempo_max = $value;
    }
    public function setDataAplicacao($value){
        $this->data_aplicacao = $value;
    }
    public function setHorarioInicio($value){
        $this->horario_inicio = $value;
    }
    public function setHorarioTermino($value){
        $this->horario_termino = $value;
    }
    public function setStatus($value){
        $this->status = $value;
    }

}

