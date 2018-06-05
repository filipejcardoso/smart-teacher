<?php

namespace App\Controllers;

class ProvaController
{
	private $nota_final;
	private $numero_questoes_correta;
	private $numero_questoes_incorreta;
	private $numero_questoes_nao_respondida;
    private $sala;
    private $questoes;
    private $questoes_textos;
    private $respostas;
    private $salas_questoes;

    public function show($id)
    {

        $sala_aluno = \App\Models\SalasAlunosModel::selectAllById($id);

        $this->setNotasFinais($sala_aluno);

        $this->loadQuestoes($sala_aluno);

 		//exibe a pagina
       \App\View::make('prova',['nota_final'=>$this->nota_final,'numero_questoes_correta'=>$this->numero_questoes_correta,'numero_questoes_incorreta'=>$this->numero_questoes_incorreta,'numero_questoes_nao_respondida'=>$this->numero_questoes_nao_respondida,'prova'=>$this->sala,'questoes'=>$this->questoes,'questoes_textos'=>$this->questoes_textos,'respostas'=>$this->respostas,'sala_questoes'=>$this->salas_questoes]);
    }

    public function setNotasFinais($sala_aluno)
    {
    	$sala = \App\Models\SalasModel::selectAllById($sala_aluno->getSala());
    	$numero_questoes = \App\Models\SalasTemasModel::selectCountBySala($sala_aluno->getSala());

    	if($numero_questoes!=0)
    		$valor_questao = 10/$numero_questoes;
    	else
    		$valor_questao = 10;

    	$this->numero_questoes_correta = \App\Models\SalasQuestoesModel::selectCountCorretasByAluno($sala_aluno->getId());
    	$this->numero_questoes_incorreta = \App\Models\SalasQuestoesModel::selectCountIncorretasByAluno($sala_aluno->getId());
    	$this->numero_questoes_nao_respondida = \App\Models\SalasQuestoesModel::selectCountNaoRespondidaByAluno($sala_aluno->getId());

    	$fator = $sala->getIncorreta();

    	$this->nota_final = $valor_questao*($this->numero_questoes_correta - $this->numero_questoes_incorreta*$fator);

        if($this->nota_final<0)
            $this->nota_final = 0;

    }

     public function loadQuestoes($sala_aluno)
    {
        $questoes_textos = new \ArrayObject();
        $respostas = new \ArrayObject();

        $inner = \App\Models\QuestoesModel::selectAllInnerSalasQuestoesOnAluno($sala_aluno->getId());
        
        $questoes = $inner[0];
        $salas_questoes = $inner[1];

        foreach($questoes as $questao)
        {
            $_respostas = \App\Models\RespostasModel::selectAllByQuestao($questao->getId());
            $_questoes_textos = \App\Models\QuestoesTextoModel::selectAllByQuestao($questao->getId());
    
            $_respostas = embaralharArray($_respostas);

            $respostas->append($_respostas);
            $questoes_textos->append($_questoes_textos);
        }

        $sala = $sala_aluno->getSala();


        $this->sala = $sala;
        $this->questoes = $questoes;
        $this->questoes_textos = $questoes_textos;
        $this->respostas = $respostas;
        $this->salas_questoes = $salas_questoes;
    }

}
