<?php

namespace App\Controllers;

class ListTemasController
{

    public function show($disciplina)
    {
        $temas = \App\Models\TemasModel::selectAllByDisciplina($disciplina);

 		//exibe a pagina
        \App\View::make('listtemas',['temas'=>$temas]);
    }

}

