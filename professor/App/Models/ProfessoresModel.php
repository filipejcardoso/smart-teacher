<?php 
namespace App\Models; 

use App\DB; 
use \App\Espelhos;
use \ArrayObject;

class ProfessoresModel
{
   
    public static function checkLogin($usuario,$senha) 
    { 
      $temas = new ArrayObject();

      $sql = "SELECT * FROM professores WHERE (usuario='".$usuario."' AND senha='".$senha."') ORDER BY id ASC LIMIT 0,1"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      if($registros!=null)
        return 1;
      else
        return 0;
    }
    public static function selectNomeByUsuarioSenha($usuario,$senha) 
    { 
      $temas = new ArrayObject();

      $sql = "SELECT * FROM professores WHERE (usuario='".$usuario."' AND senha='".$senha."') ORDER BY id ASC LIMIT 0,1"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      return $registros[0]['nome'];
    }    
    public static function selectIdByUsuarioSenha($usuario,$senha) 
    { 
      $temas = new ArrayObject();

      $sql = "SELECT * FROM professores WHERE (usuario='".$usuario."' AND senha='".$senha."') ORDER BY id ASC LIMIT 0,1"; 

      $DB = new DB; 

      $stmt = $DB->prepare($sql);
 
      $stmt->execute();
 
      $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      return $registros[0]['id'];
    }
}