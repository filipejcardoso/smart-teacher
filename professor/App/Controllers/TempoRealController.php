<?php

namespace App\Controllers;

class TempoRealController
{

    public function show($id)
    {
	    $sala = \App\Models\SalasModel::selectAllById($id);

 		//exibe a pagina
        \App\View::make('temporeal',['sala'=>$sala]);
    }
    public function finalizar($sala)
    {
	    \App\Models\SalasModel::finalizar($sala);
    	header('location:/estatisticas?sala='.$sala);
		exit(); 		
    }
    public function liberar($sala)
    {
	    \App\Models\SalasModel::liberar($sala);
    	header('location:/temporeal?sala='.$sala);
		exit(); 		
    }
    public function getInfoAlunos($sala)
    {
        $value = \App\Models\SalasAlunosModel::selectNumeroAlunosBySala($sala);
        $value.= "&".\App\Models\SalasAlunosModel::selectNumeroAlunosFinalizadoBySala($sala);
        $value.= "&".\App\Models\SalasAlunosModel::selectNumeroAlunosRestanteBySala($sala);

        echo $value;
    }
    public function getFinalizado($sala)
    {
        $value = \App\Models\SalasModel::selectAllById($sala);

        if($this->getIsTime($sala) == 0 || $value->getStatus() == 0)
            echo '0';
        else
            echo '1';
    }
    public function getTempoRestante($sala)
    {
        $value = \App\Models\SalasModel::selectAllById($sala);

        $data_atual = new \DateTime(date("Y-m-d H:i:s"));
        $data_inicio = new \DateTime($value->getHorarioInicio());

        $diff = $data_inicio->diff($data_atual,true);

        $dia = $diff->format("%a") * 24*60;
        $hora = $diff->format("%h") * 60; 
        $minuto = $diff->format("%i");
        $segundo = $diff->format("%s")/60;

        $total_minutos = $dia + $hora + $minuto + $segundo;
        
        $restante = $value->getTempoMax() - $total_minutos;
        
        $minutos = (int)$restante;
        $segundos = number_format(($restante-$minutos)*60,'0');

        if($minutos<0)
            $minutos = 0;
        if($segundos<0)
            $segundos =0;

        echo sprintf("%02d",$minutos).":".sprintf("%02d",$segundos);
    }
    public function getIsTime($sala)
    {
        $value = \App\Models\SalasModel::selectAllById($sala);

        $data_atual = new \DateTime(date("Y-m-d H:i:s"));
        $data_inicio = new \DateTime($value->getHorarioInicio());

        $diff = $data_inicio->diff($data_atual,true);

        $dia = $diff->format("%a") * 24*60;
        $hora = $diff->format("%h") * 60; 
        $minuto = $diff->format("%i");
        $segundo = $diff->format("%s")/60;

        $total_minutos = $dia + $hora + $minuto + $segundo;
        
        $restante = $value->getTempoMax() - $total_minutos;
        
        $minutos = (int)$restante;
        $segundos = number_format(($restante-$minutos)*60,'0');

        if($minutos<= 0 && $segundos<=0)
            return 0;
        else
            return 1;
    }

}

