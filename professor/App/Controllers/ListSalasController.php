<?php

namespace App\Controllers;

class ListSalasController
{

    public function show()
    {
	    $salas = \App\Models\SalasModel::selectAllByProfessor($_SESSION['PROFESSOR']);

 		//exibe a pagina
        \App\View::make('listsalas',['salas'=>$salas]);
    }

}

