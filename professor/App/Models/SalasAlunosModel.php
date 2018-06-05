<?php 
namespace App\Models; 

use App\DB; 
use \App\Espelhos;
use \ArrayObject;

class SalasAlunosModel
{
   
    public static function selectAllBySala($sala) 
    { 
      $sql = "SELECT * FROM salas_alunos WHERE sala='".$sala."' ORDER BY nome ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $salas_alunos = new \ArrayObject;
      foreach ($registros as $registro) 
      {
        $sala_aluno = new \App\Espelhos\SalasAlunosEspelho;

        $sala_aluno->setId($registro['id']);
        $sala_aluno->setSala($registro['sala']);
        $sala_aluno->setNome($registro['nome']);
        $sala_aluno->setRa($registro['ra']);
        $sala_aluno->setTurma($registro['turma']);
        $sala_aluno->setTempoTermino($registro['tempo_termino']);
        $sala_aluno->setNotaFinal($registro['nota_final']);
        $sala_aluno->setStatus($registro['status']);

        $salas_alunos->append($sala_aluno);
      }
        
      return $salas_alunos;
    }
    public static function selectAllById($id) 
    { 
      $sql = "SELECT * FROM salas_alunos WHERE id='".$id."' ORDER BY nome ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $sala_aluno = new \App\Espelhos\SalasAlunosEspelho;
      foreach ($registros as $registro) 
      {

        $sala_aluno->setId($registro['id']);
        $sala_aluno->setSala($registro['sala']);
        $sala_aluno->setNome($registro['nome']);
        $sala_aluno->setRa($registro['ra']);
        $sala_aluno->setTurma($registro['turma']);
        $sala_aluno->setTempoTermino($registro['tempo_termino']);
        $sala_aluno->setNotaFinal($registro['nota_final']);
        $sala_aluno->setStatus($registro['status']);
      }
        
      return $sala_aluno;
    }

    public static function selectMediaBySala($sala)
    {
      $sql = "SELECT id AS id, sala AS sala, AVG(nota_final) AS media FROM salas_alunos WHERE sala='".$sala."' ORDER BY id ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      if($registros!=null)
        return $registros[0]["media"];
      else
        return 0;

    }
    public static function selectMaxBySala($sala)
    {
      $sql = "SELECT id AS id, sala AS sala, MAX(nota_final) AS nota_final FROM salas_alunos WHERE sala='".$sala."' ORDER BY id ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      if($registros!=null)
        return $registros[0]["nota_final"];
      else
        return 0;
    }
    public static function selectMinBySala($sala)
    {
      $sql = "SELECT id AS id, sala AS sala, MIN(nota_final) AS nota_final FROM salas_alunos WHERE sala='".$sala."' ORDER BY id ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      if($registros!=null)
        return $registros[0]["nota_final"];
      else
        return 0;
    }
    public static function selectNumeroAlunosBySala($sala)
    {
      $sql = "SELECT COUNT(id) AS numero_alunos,sala AS sala FROM salas_alunos WHERE sala='".$sala."' ORDER BY id ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      if($registros!=null)
        return $registros[0]["numero_alunos"];
      else
        return 0;
    }
    public static function selectNumeroAlunosFinalizadoBySala($sala)
    {
      $sql = "SELECT COUNT(id) AS numero_alunos, sala AS sala, status AS status FROM salas_alunos WHERE sala='".$sala."' AND status='0' ORDER BY id ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      if($registros!=null)
        return $registros[0]["numero_alunos"];
      else
        return 0;
    }
    public static function selectNumeroAlunosRestanteBySala($sala)
    {
      $sql = "SELECT COUNT(id) AS numero_alunos, status AS status, sala AS sala FROM salas_alunos WHERE sala='".$sala."' AND status='1' ORDER BY id ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      if($registros!=null)
        return $registros[0]["numero_alunos"];
      else
        return 0;
    }
}