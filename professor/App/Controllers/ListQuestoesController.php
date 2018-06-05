<?php

namespace App\Controllers;

class ListQuestoesController
{

    public function show($tema)
    {
        $questoes = \App\Models\QuestoesModel::selectAllByTema($tema);

        //exibe a pagina
        \App\View::make('listquestoes',['questoes'=>$questoes]);
    }

}