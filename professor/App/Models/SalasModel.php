<?php 
namespace App\Models; 

use App\DB; 
use \App\Espelhos;
use \ArrayObject;

class SalasModel
{
   
    public static function selectAllById($id) 
    { 
      $sql = "SELECT * FROM salas WHERE id='".$id."' ORDER BY id ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $sala = new \App\Espelhos\SalasEspelho;
      foreach ($registros as $registro) 
      {
        $sala->setId($registro['id']);
        $sala->setProfessor($registro['professor']);
        $sala->setDisciplina(\App\Models\DisciplinasModel::selectDescricaoById($registro['disciplina']));
        $sala->setDescricao($registro['descricao']);
        $sala->setNumeroQuestoes($registro['numero_questoes']);
        $sala->setIncorreta($registro['incorreta']);
        $sala->setAlunosMax($registro['alunos_max']);
        $sala->setTempoMax($registro['tempo_max']);
        $sala->setDataAplicacao($registro['data_aplicacao']);
        $sala->setHorarioInicio($registro['horario_inicio']);
        $sala->setHorarioTermino($registro['horario_termino']);
        $sala->setStatus($registro['status']);
      }
        
      return $sala;
    }
    public static function selectRecentesByProfessor($professor) 
    { 
      $salas = new ArrayObject();

      $sql = "SELECT * FROM salas WHERE status='0' AND professor='".$professor."' ORDER BY id DESC LIMIT 0,3"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      foreach ($registros as $registro) 
      {
        $sala = new \App\Espelhos\SalasEspelho;

        $sala->setId($registro['id']);
        $sala->setProfessor($registro['professor']);
        $sala->setDisciplina(\App\Models\DisciplinasModel::selectDescricaoById($registro['disciplina']));
        $sala->setDescricao($registro['descricao']);
        $sala->setNumeroQuestoes($registro['numero_questoes']);
        $sala->setIncorreta($registro['incorreta']);
        $sala->setAlunosMax($registro['alunos_max']);
        $sala->setTempoMax($registro['tempo_max']);
        $sala->setDataAplicacao($registro['data_aplicacao']);
        $sala->setHorarioInicio($registro['horario_inicio']);
        $sala->setHorarioTermino($registro['horario_termino']);
        $sala->setStatus($registro['status']);
        
        $salas->append($sala);
      }
      return $salas;
    }

    public static function selectAllByProfessor($professor) 
    { 
      $salas = new ArrayObject();

      $sql = "SELECT * FROM salas WHERE (professor='".$professor."') ORDER BY id DESC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      foreach ($registros as $registro) 
      {
        $sala = new \App\Espelhos\SalasEspelho;

        $sala->setId($registro['id']);
        $sala->setProfessor($registro['professor']);
        $sala->setDisciplina(\App\Models\DisciplinasModel::selectDescricaoById($registro['disciplina']));
        $sala->setDescricao($registro['descricao']);
        $sala->setNumeroQuestoes($registro['numero_questoes']);
        $sala->setIncorreta($registro['incorreta']);
        $sala->setAlunosMax($registro['alunos_max']);
        $sala->setTempoMax($registro['tempo_max']);
        $sala->setDataAplicacao($registro['data_aplicacao']);
        $sala->setHorarioInicio($registro['horario_inicio']);
        $sala->setHorarioTermino($registro['horario_termino']);
        $sala->setStatus($registro['status']);
        
        $salas->append($sala);
      }

      return $salas;
    }

    public static function selectAtivasByProfessor($professor) 
    { 
      $salas = new ArrayObject();

      $sql = "SELECT * FROM salas WHERE (professor='".$professor."' AND (status='1' OR status='2')) ORDER BY id DESC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      foreach ($registros as $registro) 
      {
        $sala = new \App\Espelhos\SalasEspelho;

        $sala->setId($registro['id']);
        $sala->setProfessor($registro['professor']);
        $sala->setDisciplina(\App\Models\DisciplinasModel::selectDescricaoById($registro['disciplina']));
        $sala->setDescricao($registro['descricao']);
        $sala->setNumeroQuestoes($registro['numero_questoes']);
        $sala->setIncorreta($registro['incorreta']);
        $sala->setAlunosMax($registro['alunos_max']);
        $sala->setTempoMax($registro['tempo_max']);
        $sala->setDataAplicacao($registro['data_aplicacao']);
        $sala->setHorarioInicio($registro['horario_inicio']);
        $sala->setHorarioTermino($registro['horario_termino']);
        $sala->setStatus($registro['status']);
        
        $salas->append($sala);
      }

      return $salas;
    }

    public static function selectFinalizadasByProfessor($professor) 
    { 
      $salas = new ArrayObject();

      $sql = "SELECT * FROM salas WHERE (professor='".$professor."' AND status='0') ORDER BY id DESC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      foreach ($registros as $registro) 
      {
        $sala = new \App\Espelhos\SalasEspelho;

        $sala->setId($registro['id']);
        $sala->setProfessor($registro['professor']);
        $sala->setDisciplina(\App\Models\DisciplinasModel::selectDescricaoById($registro['disciplina']));
        $sala->setDescricao($registro['descricao']);
        $sala->setNumeroQuestoes($registro['numero_questoes']);
        $sala->setIncorreta($registro['incorreta']);
        $sala->setAlunosMax($registro['alunos_max']);
        $sala->setTempoMax($registro['tempo_max']);
        $sala->setDataAplicacao($registro['data_aplicacao']);
        $sala->setHorarioInicio($registro['horario_inicio']);
        $sala->setHorarioTermino($registro['horario_termino']);
        $sala->setStatus($registro['status']);
        
        $salas->append($sala);
      }

      return $salas;
    }

    public static function insert($sala)
    {
      $sql = "INSERT INTO salas (professor,disciplina,descricao,numero_questoes,incorreta,alunos_max,tempo_max,data_aplicacao,status)";
      $sql.= " VALUES ('".$sala->getProfessor()."'";
      $sql.= ",'".$sala->getDisciplina()."'";
      $sql.= ",'".$sala->getDescricao()."'"; 
      $sql.= ",'".$sala->getNumeroQuestoes()."'";
      $sql.= ",'".$sala->getIncorreta()."'";
      $sql.= ",'".$sala->getAlunosMax()."'"; 
      $sql.= ",'".$sala->getTempoMax()."'"; 
      $sql.= ",'".$sala->getDataAplicacao()."'";
      $sql.= ",'".$sala->getStatus()."')"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();

      if($stmt->rowCount()!=0)
        return $DB->lastInsertId();
      else
        return 0;
    }

    public static function liberar($sala)
    {
      $sql = "UPDATE salas SET status='2',horario_inicio='".date("Y-m-d H:i:s")."'  WHERE id='".$sala."'";

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();

      return $stmt->rowCount();
    }

    public static function finalizar($sala)
    {
      $sql = "UPDATE salas SET status='0',horario_termino='".date("Y-m-d H:i:s")."' WHERE id='".$sala."'";

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();

      return $stmt->rowCount();
    }
}