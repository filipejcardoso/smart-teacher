<?php

namespace App\Controllers;

class ListSalasAtivasController
{

    public function show()
    {
    	$salas = \App\Models\SalasModel::selectAtivasByProfessor($_SESSION['PROFESSOR']);

 		//exibe a pagina
        \App\View::make('listsalasativas',['salas'=>$salas]);
    }

}

