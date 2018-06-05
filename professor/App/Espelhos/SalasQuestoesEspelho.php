<?php

namespace App\Espelhos;

class SalasQuestoesEspelho
{
    private $id;
    private $aluno;
    private $questao;
    private $resposta;
	
    public function getId(){
        return $this->id;
    }
    public function getAluno(){
        return $this->aluno;
    }
    public function getQuestao(){
        return $this->questao;
    }
    public function getResposta(){
        return $this->resposta;
    }

    public function setId($value){
        $this->id = $value;
    }
    public function setAluno($value){
        $this->aluno = $value;
    }
    public function setQuestao($value){
        $this->questao = $value;
    }
    public function setResposta($value){
        $this->resposta = $value;
    }

}

