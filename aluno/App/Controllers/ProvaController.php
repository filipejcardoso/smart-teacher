<?php

namespace App\Controllers;

if(!isset($_SESSION))
     session_start();

class ProvaController
{

    public function show()
    {
        $sala_aluno = new \App\Espelhos\SalasAlunosEspelho;
    
        $sala_aluno->setSala($_SESSION['sala']);
        $sala_aluno->setNome($_SESSION['nome']);
        $sala_aluno->setRa($_SESSION['ra']);
        $sala_aluno->setTurma($_SESSION['turma']);

        $id = \App\Models\SalasAlunosModel::isRegistroByRaSala($sala_aluno);

    	if($id!=0)
    	{
    		$_SESSION['aluno'] = $id;

    		$sala_aluno->setId($id);
    		$this->showLoad($sala_aluno);
    	}
    	else
    		$this->showRand($sala_aluno);
    }

    public function showLoad($sala_aluno)
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

 		//exibe a pagina
        \App\View::make('prova',['prova'=>$sala,'questoes'=>$questoes,'questoes_textos'=>$questoes_textos,'respostas'=>$respostas,'sala_questoes'=>$salas_questoes]);
    }

    public function showRand($sala_aluno)
    {
	    $questoes = new \ArrayObject();
	    $questoes_textos = new \ArrayObject();
	    $respostas = new \ArrayObject();
	    $sala_questoes = new \ArrayObject();

        $_SESSION['aluno'] = \App\Models\SalasAlunosModel::insert($sala_aluno);

    	$salas_temas = \App\Models\SalasTemasModel::selectAllBySala($sala_aluno->getSala());

    	foreach($salas_temas as $sala_tema)
		{
		    $aleatorios = new \ArrayObject();
			$_questoes = \App\Models\QuestoesModel::selectAllByTema($sala_tema->getTema());

			
			if($_questoes->count()>0)
				for($i=0;$i<$sala_tema->getQuantidade();$i++)
				{
					$existente = 1;
					
					while($existente == 1)
					{
						$aleatorio = rand(1,$_questoes->count());
						$aleatorio--;

						$existente = 0;
						foreach($aleatorios as $a)
						{
							if($a == $aleatorio)
								$existente = 1;
						}
					}	
					
					$aleatorios->append($aleatorio);
				
					$questao = $_questoes[$aleatorio];

					$_respostas = \App\Models\RespostasModel::selectAllByQuestao($questao->getId());
					$_questoes_textos = \App\Models\QuestoesTextoModel::selectAllByQuestao($questao->getId());

					$_respostas = embaralharArray($_respostas);

					$respostas->append($_respostas);
					$questoes_textos->append($_questoes_textos);
					$questoes->append($questao);

					$sala_questao = new \App\Espelhos\SalasQuestoesEspelho;

					$sala_questao->setAluno($_SESSION['aluno']);
					$sala_questao->setQuestao($questao->getId());
					$sala_questao->setResposta(0);
					$sala_questao->setId(\App\Models\SalasQuestoesModel::insert($sala_questao));
					
					$sala_questoes->append($sala_questao);
				}
		}

 		//exibe a pagina
        \App\View::make('prova',['prova'=>$sala_aluno->getSala(),'questoes'=>$questoes,'questoes_textos'=>$questoes_textos,'respostas'=>$respostas,'sala_questoes'=>$sala_questoes]);
    }

    public function updateQuestoes($sala_questao)
    {
    	\App\Models\SalasQuestoesModel::update($sala_questao);
    	echo $sala_questao->getId()."-".$sala_questao->getResposta();
    }


}

