<?php
namespace App\Controllers;

session_start();

class ConfirmLoginController
{

    public function checkLogin($usuario,$senha)
    {
 		if(\App\Models\ProfessoresModel::checkLogin($usuario,$senha))
 		{

			$_SESSION['PROFESSOR'] = \App\Models\ProfessoresModel::selectIdByUsuarioSenha($usuario,$senha);
			$_SESSION['NOME_USUARIO'] = \App\Models\ProfessoresModel::selectNomeByUsuarioSenha($usuario,$senha);
			$_SESSION['LOGADO'] = 1;
			header('location:/dashboard');
			exit(); 		
		}
		else
		{
			$_SESSION['LOGADO'] = 0;
			header('location:/login');	
			exit();	
		}
    }

}

