<?php 

/** * Retorna o diretório das views */ 
function viewsPath() 
{
	return BASE_PATH . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR;
}
function strtoupper_utf8($string){
    $string=utf8_decode($string);
    $string=strtoupper($string);
    $string=utf8_encode($string);
    return $string;
}
function strtolower_utf8($string){
    $string=utf8_decode($string);
    $string=strtolower($string);
    $string=utf8_encode($string);
    return $string;
}
function toRoundCeil($value)
{
	$i = 0;
	while(true)
	{
		if($value<10)
			break;
		else
		{
			$i++;
			$value = $value/10;
		}
	}

	$value = ceil($value)*pow(10,$i);
	
	return ($value);
}
function dividirIntervalo($value1,$value2,$n)
{
	$partes_array = new ArrayObject;
	
	$v1 = toRoundCeil($value1);
	$v2 = toRoundCeil($value2);

	$intervalo = $v1-$v2;

	if($intervalo<0)
		$intervalo = $intervalo*(-1);

	if($n!=0 && $intervalo>0)
	{
		$partes = ceil($intervalo/$n);

		for($i=0;$i<($n-1);$i++)
			$partes_array->append($partes*($i+1));

		if($v1>$v2)
			$partes_array->append($v1);
		else
			$partes_array->append($v2);
	}

	return $partes_array;
}

function embaralharArray($vet)
{
	$nvet = new \ArrayObject();
	$aleatorios = new \ArrayObject();

	$count = $vet->count();

	for($i=0;$i<$count;$i++)
	{
		$existente = 1;
					
		while($existente == 1)
		{
			$aleatorio = rand(1,$count);
			$aleatorio--;

			$existente = 0;
			foreach($aleatorios as $a)
			{
				if($a == $aleatorio)
					$existente = 1;
			}
		}	

		$aleatorios->append($aleatorio);

		$nvet->append($vet[$aleatorio]);
	}

	return $nvet;
}