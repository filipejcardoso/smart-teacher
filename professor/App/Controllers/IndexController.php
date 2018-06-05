<?php

namespace App\Controllers;

class IndexController
{

    public function show()
    {
    	$salas = \App\Models\SalasModel::selectRecentesByProfessor($_SESSION['PROFESSOR']);

    	$recentes = new \ArrayObject;
    	
    	foreach($salas as $sala)
    	{
    		$recente = new \App\Classes\SalasRecentes;

            $recente->setId($sala->getId());
            $recente->setDescricao($sala->getDescricao());
    		$recente->setData($sala->getDataAplicacao());
    		$recente->setAlunos(\App\Models\SalasAlunosModel::selectNumeroAlunosBySala($sala->getId()));
	    	$recente->setMedia(\App\Models\SalasAlunosModel::selectMediaBySala($sala->getId()));
	    	$recente->setMaiorNota(\App\Models\SalasAlunosModel::selectMaxBySala($sala->getId()));
	    	$recente->setMenorNota(\App\Models\SalasAlunosModel::selectMinBySala($sala->getId()));

	    	$recentes->append($recente);
    	}

 		//exibe a pagina
        \App\View::make('index',['recentes'=>$recentes]);
    }

}

