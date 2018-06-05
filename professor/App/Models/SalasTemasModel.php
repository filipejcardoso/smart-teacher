<?php 
namespace App\Models; 

use App\DB; 
use \App\Espelhos;
use \ArrayObject;

class SalasTemasModel
{
   
    public static function selectAllBySala($sala) 
    { 
      $salas_temas = new ArrayObject();

      $sql = "SELECT * FROM salas_temas WHERE sala='".$sala."' ORDER BY id ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      foreach ($registros as $registro) 
      {
        $sala_tema = new \App\Espelhos\SalasTemasEspelho;

        $sala_tema->setId($registro['id']);
        $sala_tema->setSala($registro['sala']);
        $sala_tema->setTema($registro['tema']);
        $sala_tema->setQuantidade($registro['quantidade']);
        
        $salas_temas->append($sala_tema);
      }

      return $salas_temas;
    }
    public static function selectCountBySala($sala) 
    { 
      $salas_temas = new ArrayObject();

      $sql = "SELECT id AS id, SUM(quantidade) AS size,sala AS sala FROM salas_temas WHERE sala='".$sala."' ORDER BY id ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      if($registros!=null)
        return $registros[0]['size'];
      else
        return 0;
    }
    public static function insert($sala_tema)
    {
      $sql = "INSERT INTO salas_temas (sala,tema,quantidade)";
      $sql.= " VALUES ('".$sala_tema->getSala()."'";
      $sql.= ",'".$sala_tema->getTema()."'";
      $sql.= ",'".$sala_tema->getQuantidade()."')"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();

      if($stmt->rowCount()!=0)
        return $DB->lastInsertId();
      else
        return 0;
    }
}