<?php 
namespace App\Models; 

use App\DB; 
use \App\Espelhos;
use \ArrayObject;

class TemasModel
{
   
    public static function selectAllByDisciplina($disciplina) 
    { 
      $temas = new ArrayObject();

      $sql = "SELECT * FROM temas WHERE disciplina='".$disciplina."' ORDER BY descricao ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);
 
      foreach ($registros as $registro) 
      {
        $tema = new \App\Espelhos\TemasEspelho;

        $tema->setId($registro['id']);
        $tema->setDescricao($registro['descricao']);
        $tema->setDisciplina($registro['disciplina']);
        
        $temas->append($tema);
      }

      return $temas;
    }
}