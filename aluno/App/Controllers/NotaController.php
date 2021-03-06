<?php

namespace App\Controllers;

if(!isset($_SESSION))
     session_start();

class NotaController
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

    public function show()
    {

        if($_SESSION['sala'] == null)
        {
           header('Location: /');
           exit();
        }
    	
        $sala_aluno = new \App\Espelhos\SalasAlunosEspelho;

        $this->setNotasFinais();

    	$sala_aluno->setId($_SESSION['aluno']);
        $sala_aluno->setSala($_SESSION['sala']);
        $sala_aluno->setNome($_SESSION['nome']);
        $sala_aluno->setRa($_SESSION['ra']);
        $sala_aluno->setTurma($_SESSION['turma']);
    	$sala_aluno->setTempoTermino($this->getTempoTermino());
    	$sala_aluno->setNotaFinal($this->nota_final);
    	$sala_aluno->setStatus(0);

        $this->loadQuestoes($sala_aluno);

    	\App\Models\SalasAlunosModel::updateFinalizar($sala_aluno);

   		$_SESSION['aluno'] = null;
   		$_SESSION['sala'] = null;
   		$_SESSION['ra'] = null;
   		$_SESSION['turma'] = null;
   		$_SESSION['nome'] = null;

 		//exibe a pagina
       \App\View::make('nota',['nota_final'=>$this->nota_final,'numero_questoes_correta'=>$this->numero_questoes_correta,'numero_questoes_incorreta'=>$this->numero_questoes_incorreta,'numero_questoes_nao_respondida'=>$this->numero_questoes_nao_respondida,'prova'=>$this->sala,'questoes'=>$this->questoes,'questoes_textos'=>$this->questoes_textos,'respostas'=>$this->respostas,'sala_questoes'=>$this->salas_questoes]);
    }

    public function setNotasFinais()
    {
    	$sala = \App\Models\SalasModel::selectAllById($_SESSION['sala']);
    	$numero_questoes = \App\Models\SalasTemasModel::selectCountBySala($_SESSION['sala']);

    	if($numero_questoes!=0)
    		$valor_questao = 10/$numero_questoes;
    	else
    		$valor_questao = 10;

    	$this->numero_questoes_correta = \App\Models\SalasQuestoesModel::selectCountCorretasByAluno($_SESSION['aluno']);
    	$this->numero_questoes_incorreta = \App\Models\SalasQuestoesModel::selectCountIncorretasByAluno($_SESSION['aluno']);
    	$this->numero_questoes_nao_respondida = \App\Models\SalasQuestoesModel::selectCountNaoRespondidaByAluno($_SESSION['aluno']);

    	$fator = $sala->getIncorreta();

    	$this->nota_final = $valor_questao*($this->numero_questoes_correta - $this->numero_questoes_incorreta*$fator);

        if($this->nota_final<0)
            $this->nota_final = 0;

    }

    public function getTempoTermino()
    {
        $value = \App\Models\SalasModel::selectAllById($_SESSION['sala']);

        $data_atual = new \DateTime(date("Y-m-d H:i:s"));
        $data_inicio = new \DateTime($value->getHorarioInicio());

        $diff = $data_inicio->diff($data_atual,true);

        $dia = $diff->format("%a") * 24*60;
        $hora = $diff->format("%h") * 60; 
        $minuto = $diff->format("%i");
        $segundo = $diff->format("%s")/60;

        $total_minutos = $dia + $hora + $minuto + $segundo;
		
		return (int)$total_minutos;       
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

