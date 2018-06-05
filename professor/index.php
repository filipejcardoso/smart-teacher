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
$app->get('/login',function()
{
	$view = new App\Controllers\LoginController;
	$view->show();
});
$app->post('/confirm-login',function ($request)
{
	$usuario = $request->getParsedBody()['usuario'];
	$senha = $request->getParsedBody()['senha'];
	$view = new App\Controllers\ConfirmLoginController;
	$view->checkLogin($usuario,$senha);

});
$app->post('/liberarsala-request',function ($request)
{
	$sala = $request->getParsedBody()['sala_liberar'];
	$view = new App\Controllers\TempoRealController;
	$view->liberar($sala);

});
$app->post('/finalizarsala-request',function ($request)
{
	$sala = $request->getParsedBody()['sala_finalizar'];
	$view = new App\Controllers\TempoRealController;
	$view->finalizar($sala);

});
$app->get('/temporeal_alunos-request',function ($request)
{

	$sala = @$request->getQueryParams()['sala'];
	$view = new App\Controllers\TempoRealController;
	$view->getInfoAlunos($sala);
});
$app->get('/prova',function ($request)
{

	$prova = @$request->getQueryParams()['prova'];
	$view = new App\Controllers\ProvaController;
	$view->show($prova);
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
$app->post('/createsala-request',function ($request)
{
	$sala = new \App\Espelhos\SalasEspelho();
	$salas_temas = new \ArrayObject();

	$sala->setProfessor($_SESSION['PROFESSOR']);
	$sala->setDisciplina($request->getParsedBody()['disciplina']);
	$sala->setDescricao($request->getParsedBody()['descricao']);
	$sala->setNumeroQuestoes(0);
	$sala->setIncorreta($request->getParsedBody()['incorreta']);
	$sala->setAlunosMax($request->getParsedBody()['nalunos']);
	$sala->setTempoMax($request->getParsedBody()['tempomax']);
	$sala->setDataAplicacao(date("Y-m-d"));
	$sala->setStatus(1);

	$size_tema = $request->getParsedBody()['size_temas'];
	for($i=0;$i<$size_tema;$i++)
	{
		$sala_tema = new \App\Espelhos\SalasTemasEspelho();
		$sala_tema->setTema($request->getParsedBody()['tema_'.$i]);
		$sala_tema->setQuantidade($request->getParsedBody()['nquestoes_tema_'.$i]);
		$sala->setNumeroQuestoes($request->getParsedBody()['nquestoes_tema_'.$i] + $sala->getNumeroQuestoes());

		$salas_temas->append($sala_tema);
	}

	$view = new App\Controllers\CreateSalaController;
	$view->insert($sala,$salas_temas);

});
$app->get('/dashboard',function()
{
	$view = new App\Controllers\IndexController;
	$view->show();
});
$app->get('/createsala', function ($request)
{
	$disciplina = @$request->getQueryParams()['disciplina'];
	$view = new App\Controllers\CreatesalaController;
	$view->show($disciplina);
});
$app->get('/selectdisciplina',function()
{
	$view = new App\Controllers\SelectDisciplinaController;
	$view->show();
});
$app->get('/listsalasativas',function()
{
	$view = new App\Controllers\ListSalasAtivasController;
	$view->show();
});
$app->get('/temporeal',function ($request)
{
	$sala = @$request->getQueryParams()['sala'];
	$view = new App\Controllers\TempoRealController;
	$view->show($sala);
});
$app->get('/estatisticas',function ($request)
{
	$sala = @$request->getQueryParams()['sala'];
	$view = new App\Controllers\EstatisticasController;
	$view->show($sala);
});
$app->get('/listdisciplinas',function()
{
	$view = new App\Controllers\ListDisciplinasController;
	$view->show();
});
$app->get('/listtemas', function ($request)
{
	$disciplina = @$request->getQueryParams()['disciplina'];
	$view = new App\Controllers\ListTemasController;
	$view->show($disciplina);
});
$app->get('/listquestoes', function ($request)
{
	$tema = @$request->getQueryParams()['tema'];
	$view = new App\Controllers\ListQuestoesController;
	$view->show($tema);
});
$app->get('/listsalas',function()
{
	$view = new App\Controllers\ListSalasController;
	$view->show();
});
$app->run();
