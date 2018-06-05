<?php

namespace App\Controllers;

use \App\Models;

if(!isset($_SESSION))
     session_start();

class SelectDisciplinaController
{

    public function show()
    {
        $disciplinas = \App\Models\DisciplinasModel::selectAllByProfessor($_SESSION['PROFESSOR']);

 		//exibe a pagina
        \App\View::make('selectdisciplina',['disciplinas'=>$disciplinas]);
    }

}

