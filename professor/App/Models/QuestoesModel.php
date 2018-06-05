<?php 
namespace App\Models; 

use App\DB; 
use \App\Espelhos;
use \ArrayObject;

class QuestoesModel
{
   
    public static function selectAllByTema($tema) 
    { 
      $questoes = new ArrayObject();

      $sql = "SELECT * FROM questoes WHERE tema='".$tema."' ORDER BY descricao ASC"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);
 
      foreach ($registros as $registro) 
      {
        $questao = new \App\Espelhos\QuestoesEspelho;

        $questao->setId($registro['id']);
        $questao->setTema($registro['tema']);
        $questao->setDificuldade($registro['dificuldade']);
        
        $questoes->append($questao);
      } 
     return $questoes;
    }

    public static function selectNumeroQuestoesByTema($tema) 
    { 
      $questoes = new ArrayObject();

      $sql = "SELECT COUNT(id) AS numero ,tema FROM questoes WHERE tema='".$tema."'"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);
 
      if($registros!=null)
        return $registros[0]['numero'];
      return null;
    }

    public static function selectAllInnerSalasQuestoesOnAluno($aluno) 
    { 
      $inner = new ArrayObject();
      $questoes = new ArrayObject();
      $salas_questoes = new ArrayObject();

      $sql = "SELECT Q.id AS id,Q.tema AS tema,Q.dificuldade AS dificuldade,S.id AS id_sala_questao,S.questao AS questao,S.resposta AS resposta,S.aluno AS aluno FROM questoes AS Q INNER JOIN salas_questoes AS S ON (Q.id = S.questao) WHERE S.aluno = '".$aluno."'"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);
 
      foreach ($registros as $registro) 
      {
        $questao = new \App\Espelhos\QuestoesEspelho;

        $questao->setId($registro['id']);
        $questao->setTema($registro['tema']);
        $questao->setDificuldade($registro['dificuldade']);
        
        $questoes->append($questao);

        $sala_questao = new \App\Espelhos\SalasQuestoesEspelho;

        $sala_questao->setId($registro['id_sala_questao']);
        $sala_questao->setAluno($registro['aluno']);
        $sala_questao->setQuestao($registro['questao']);
        $sala_questao->setResposta($registro['resposta']);
        
        $salas_questoes->append($sala_questao);
      } 

     $inner->append($questoes);
     $inner->append($salas_questoes);

     return $inner;
    }
}