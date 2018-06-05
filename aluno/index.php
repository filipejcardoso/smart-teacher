<?php
if(!isset($_SESSION))
     session_start();

// inclui o autoloader do Composer 
require 'vendor/autoload.php'; 

// inclui o arquivo de inicialização 
require 'init.php'; 

// instancia o Slim, habilitando os erros (útil para debug, em desenvolvimento) 
$app = new \Slim\App([ 'settings' => ['displayErrorDetails' => true]]);

$app->get('/',function()
{
	$view = new App\Controllers\IndexController;
	$view->show();
});
$app->get('/espera-request',function ($request)
{
	$view = new App\Controllers\EsperaController;
	$view->verificarStatus(@$request->getQueryParams()['sala']);
});
$app->get('/prova_update-request',function ($request)
{
	$sala_questao = new \App\Espelhos\SalasQuestoesEspelho;

    $sala_questao->setId(@$request->getQueryParams()['id']);
    $sala_questao->setResposta(@$request->getQueryParams()['resposta']);

	$view = new App\Controllers\ProvaController;
	$view->updateQuestoes($sala_questao);
});
$app->post('/espera',function ($request)
{
	$_SESSION['sala'] = $request->getParsedBody()['id_sala'];
	$_SESSION['turma'] = $request->getParsedBody()['turma'];
	$_SESSION['ra'] = $request->getParsedBody()['ra'];
	$_SESSION['nome'] = $request->getParsedBody()['nome'];

	$view = new App\Controllers\EsperaController;
	
	if($view->verificarSala($_SESSION['sala'])!=0)
		$view->show();
	else
	{
		header('location:/');	
		exit();	
	}

});
$app->post('/prova',function ($request)
{
	$view = new App\Controllers\ProvaController;
	
	$view->show($_SESSION['sala']);

});
$app->get('/nota',function ($request)
{
	$view = new App\Controllers\NotaController;
	$view->show();
});
$app->get('/verificarSala',function ($request)
{
	$sala = $request->getQueryParams()['sala'];
	$view = new App\Controllers\TempoRealController;
	$view->getTempoRestante($sala);
});
$app->get('/temporeal_tempo-request',function ($request)
{
	$sala = $request->getQueryParams()['sala'];
	$view = new App\Controllers\TempoRealController;
	$view->getTempoRestante($sala);
});
$app->get('/temporeal_finalizado-request',function ($request)
{
	$sala = $request->getQueryParams()['sala'];
	$view = new App\Controllers\TempoRealController;
	$view->getFinalizado($sala);
});

$app->run();
