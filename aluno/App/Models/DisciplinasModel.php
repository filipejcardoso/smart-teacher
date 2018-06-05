<?php 
namespace App\Models; 

use App\DB; 
use \App\Espelhos;
use \ArrayObject;

class DisciplinasModel
{
   
    public static function selectAllByProfessor($professor) 
    { 
      $disciplinas = new ArrayObject();

      $sql = "SELECT * FROM disciplinas WHERE professor='".$professor."' ORDER BY descricao ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);
 
      foreach ($registros as $registro) 
      {
        $disciplina = new \App\Espelhos\DisciplinasEspelho;

        $disciplina->setId($registro['id']);
        $disciplina->setProfessor($registro['professor']);
        $disciplina->setDescricao($registro['descricao']);
        
        $disciplinas->append($disciplina);
      }

      return $disciplinas;
    }

    public static function selectDescricaoById($value) 
    { 
      $sql = "SELECT id,descricao FROM disciplinas WHERE id='".$value."' ORDER BY descricao ASC LIMIT 0,1"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);
 
      return $registros[0]['descricao'];
    }
}