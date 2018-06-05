<?php

namespace App\Controllers;

class LoginController
{

    public function show()
    {
 		//exibe a pagina
        \App\View::make('login');
    }

}

