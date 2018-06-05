<?php

namespace App\Controllers;

class CreatesalaController
{

    public function show($disciplina)
    {
        $numero_questoes = new \ArrayObject;
        $temas = \App\Models\TemasModel::selectAllByDisciplina($disciplina);
        $nome_disciplina = \App\Models\DisciplinasModel::selectDescricaoById($disciplina);

        foreach($temas as $tema)
            $numero_questoes->append(\App\Models\QuestoesModel::selectNumeroQuestoesByTema($tema->getId()));

 		//exibe a pagina
        \App\View::make('createsala',['disciplina'=>$nome_disciplina,'id_disciplina'=>$disciplina,'temas'=>$temas,'numero_questoes'=>$numero_questoes]);
    }
    public function insert($sala,$salas_temas)
    {
    	$id = \App\Models\SalasModel::insert($sala);

        if($id==0)
        {
            header('location:/createsala?disciplina='.$sala->getDisciplina());
            exit();         
        }

    	foreach($salas_temas as $sala_tema)
    	{
            if($sala_tema->getQuantidade() == "")
                $sala_tema->setQuantidade(0);

    		$sala_tema->setSala($id);
	    	
            \App\Models\SalasTemasModel::insert($sala_tema);
    	}
        header('location:/temporeal?sala='.$id);
        exit();         
    }

}

