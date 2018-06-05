<?php 
namespace App\Models; 

use App\DB; 
use \App\Espelhos;
use \ArrayObject;

class QuestoesTextoModel
{
   
    public static function selectAllByQuestao($questao) 
    { 
      $questoes_textos = new ArrayObject();

      $sql = "SELECT * FROM questoes_texto WHERE questao='".$questao."' ORDER BY id ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);
 
      foreach ($registros as $registro) 
      {
        $questao_texto = new \App\Espelhos\QuestoesTextoEspelho;

        $questao_texto->setId($registro['id']);
        $questao_texto->setQuestao($registro['questao']);
        $questao_texto->setCodigo($registro['codigo']);
        $questao_texto->setTexto($registro['texto']);
        
        $questoes_textos->append($questao_texto);
      }

      return $questoes_textos;
    }
}