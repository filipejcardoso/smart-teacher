<?php

namespace App\Controllers;

if(!isset($_SESSION))
     session_start();

class ListDisciplinasController
{

    public function show()
    {
	    $disciplinas = \App\Models\DisciplinasModel::selectAllByProfessor($_SESSION['PROFESSOR']);

 		//exibe a pagina
        \App\View::make('listdisciplinas',['disciplinas'=>$disciplinas]);
    }

}

