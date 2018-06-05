<?php

namespace App\Controllers;

if(!isset($_SESSION))
     session_start();
 
class EsperaController
{

    public function show()
    {
 		//exibe a pagina
        \App\View::make('espera');
    }
    public function verificarSala($sala)
    {  
        $aluno_ativo = 0;

        $sala_aluno = new \App\Espelhos\SalasAlunosEspelho;

        $sala_aluno->setSala($_SESSION['sala']);
        $sala_aluno->setNome($_SESSION['nome']);
        $sala_aluno->setRa($_SESSION['ra']);
        $sala_aluno->setTurma($_SESSION['turma']);

        $id = \App\Models\SalasAlunosModel::isRegistroByRaSala($sala_aluno);

        if($id!=0)
            $aluno_ativo = \App\Models\SalasAlunosModel::getStatusById($id);
        else
            $aluno_ativo = 1;

        if(\App\Models\SalasModel::selectAtivaById($sala) == 0 || $aluno_ativo == 0)
    	   return 0;
        else
           return 1;
    }
    public function verificarStatus($sala)
    {
    	echo \App\Models\SalasModel::verificarStatus($sala);	
    }
}

