<?php

namespace App\Controllers;

if(!isset($_SESSION))
     session_start();
 
class IndexController
{

    public function show()
    {
 		//exibe a pagina
        \App\View::make('index');
    }
}

