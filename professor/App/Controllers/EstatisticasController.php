<?php

namespace App\Controllers;

class EstatisticasController
{

    public function show($sala)
    {
	    $salas_alunos = \App\Models\SalasAlunosModel::selectAllBySala($sala);
	    $media = \App\Models\SalasAlunosModel::selectMediaBySala($sala);
	    $maior_nota = \App\Models\SalasAlunosModel::selectMaxBySala($sala);
	    $menor_nota = \App\Models\SalasAlunosModel::selectMinBySala($sala);

 		//exibe a pagina
        \App\View::make('estatisticas',['salas_alunos'=>$salas_alunos,'maior_nota'=>$maior_nota,'menor_nota'=>$menor_nota,'media'=>$media]);
    }

}

