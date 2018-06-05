<?php 
namespace App\Models; 

use App\DB; 
use \App\Espelhos;
use \ArrayObject;

class SalasQuestoesModel
{
    public static function selectAllByAluno($aluno) 
    { 
      $sql = "SELECT * FROM salas_questoes WHERE aluno='".$aluno."' ORDER BY id ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $sala_questao = new \App\Espelhos\SalasEspelho;
      foreach ($registros as $registro) 
      {
        $sala_questao->setId($registro['id']);
        $sala_questao->setAluno($registro['aluno']);
        $sala_questao->setQuestao($registro['questao']);
        $sala_questao->setResposta($registro['resposta']);
      }
        
      return $sala_questao;
    }

    public static function selectCountCorretasByAluno($aluno) 
    { 
      $sql = "SELECT COUNT(S.id) AS size,S.aluno AS aluno,S.resposta AS resposta,R.id AS resposta_id,R.correta AS correta FROM salas_questoes AS S INNER JOIN respostas AS R ON (S.resposta = R.id) WHERE (S.aluno='".$aluno."' AND R.correta='1') ORDER BY S.id ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();

      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);
 
      if($registros!=null)
        return $registros[0]['size'];
      else
        return 0;
    }

    public static function selectCountIncorretasByAluno($aluno) 
    { 
      $sql = "SELECT COUNT(S.id) AS size,S.aluno AS aluno,S.resposta AS resposta,R.id AS resposta_id,R.correta AS correta FROM salas_questoes AS S INNER JOIN respostas AS R ON (S.resposta = R.id) WHERE (S.aluno='".$aluno."' AND R.correta='0') ORDER BY S.id ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();

      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);
 
      if($registros!=null)
        return $registros[0]['size'];
      else
        return 0;
    }

    public static function selectCountNaoRespondidaByAluno($aluno) 
    { 
      $sql = "SELECT COUNT(S.id) AS size,S.aluno AS aluno,S.resposta AS resposta FROM salas_questoes AS S WHERE (S.aluno='".$aluno."' AND S.resposta='0') ORDER BY S.id ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();

      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);
 
      if($registros!=null)
        return $registros[0]['size'];
      else
        return 0;
    }


    public static function insert($sala_questao)
    {
      $sql = "INSERT INTO salas_questoes (aluno,questao,resposta)";
      $sql.= " VALUES ('".$sala_questao->getAluno()."'";
      $sql.= ",'".$sala_questao->getQuestao()."'";
      $sql.= ",'".$sala_questao->getResposta()."')"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();

      if($stmt->rowCount()!=0)
        return $DB->lastInsertId();
      else
        return 0;
    }

    public static function update($sala_questao)
    {
      $sql = "UPDATE salas_questoes SET resposta='".$sala_questao->getResposta()."' WHERE id='".$sala_questao->getId()."'";

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();

      return $stmt->rowCount();
    }


}