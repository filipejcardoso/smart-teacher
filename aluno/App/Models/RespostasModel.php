<?php 
namespace App\Models; 

use App\DB; 
use \App\Espelhos;
use \ArrayObject;

class RespostasModel
{
   
    public static function selectAllByQuestao($questao) 
    { 
      $respostas = new ArrayObject();

      $sql = "SELECT * FROM respostas WHERE questao='".$questao."' ORDER BY id ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);
 
      foreach ($registros as $registro) 
      {
        $resposta = new \App\Espelhos\RespostasEspelho;

        $resposta->setId($registro['id']);
        $resposta->setQuestao($registro['questao']);
        $resposta->setTexto($registro['texto']);
        $resposta->setCorreta($registro['correta']);

        $respostas->append($resposta);
      }

      return $respostas;
    }
}