<?php
if(!isset($_SESSION))
     session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
    <?php include("_includes/geral.php"); ?>
    <link rel="stylesheet" href="/App/Views/_includes/_css/nota.css">
    <link rel="stylesheet" href="/App/Views/_includes/_css/prova.css">
    <body>
    <main>

    	<center><h1>SUA NOTA É: <?php echo number_format($nota_final,'2'); ?></h1></center>
        <div class="row box_relatorio">
          <div class="col s12 center"><h5>RELATÓRIO</h5></div>
          <div class="col s4 center"><h5>CORRETAS: <?php echo number_format($numero_questoes_correta,'2'); ?><span id="alunos_total"></span></h5></div>
          <div class="col s4 center"><h5>INCORRETAS: <?php echo number_format($numero_questoes_incorreta,'2'); ?><span id="alunos_finalizado"></span></h5></div>
          <div class="col s4 center"><h5>NÃO RESPONDIDAS: <?php echo number_format($numero_questoes_nao_respondida,'2'); ?><span id="alunos_restante"></span></h5></div>
        </div>



        <div class="row all_questions">
          <div class="col s12">
          <center><h3>CORREÇÃO</h3></center>
          <?php $i=0; foreach ($questoes as $questao) {?>

          <div class="row box_question">
          <?php $k=0; foreach ($questoes_textos[$i] as $questao_texto) {?>
            <div class="col s12">
              <h5><?php if($k==0)echo ($i+1)." - ";echo $questao_texto->getTexto();?> </h5>
            </div>
          
            <?php if($questao_texto->getCodigo()!="") { ?>
            <div class="col s12">
              <pre style="margin:0px!important; padding: 0px!important;">
              <code class="java">
                <?php echo $questao_texto->getCodigo(); ?>
              </code>
              </pre>
            </div>
            <?php } ?>

            <?php $k++; } ?>

            <div class="col s12 box_answer">
              <?php $j=1; foreach ($respostas[$i] as $resposta) {?>
              <p class="box_answer_col <?php if($resposta->getCorreta() == 1) echo'green lighten-2'; else if($sala_questoes[$i]->getResposta() == $resposta->getId()) echo 'red lighten-2';else echo 'grey lighten-2';?>">
                <input name="group_answer<?php echo $i;?>" type="radio" id="radio<?php echo $i; echo $j; ?>" <?php if($sala_questoes[$i]->getResposta() == $resposta->getId()) echo "checked"; ?> />
                <label for="radio<?php echo $i; echo $j; ?>" class="grey-text text-darken-3 box_answer_label"><?php echo $resposta->getTexto();?></label>
              </p>
              <?php $j++; } ?>
              <p class="box_answer_col <?php if($sala_questoes[$i]->getResposta() == 0) echo'lime lighten-2'; else echo 'grey lighten-2';?> ">
                <input name="group_answer<?php echo $i;?>" type="radio" id="radio_not_<?php echo $i; ?>" <?php if($sala_questoes[$i]->getResposta() == 0) echo "checked"; ?>/>
                <label for="radio_not_<?php echo $i; ?>" class="grey-text text-darken-2 box_answer_label"><strong>NÃO RESPONDER</strong></label>
              </p>
            </div>
          </div>
          <?php $i++;} ?>

          </div>
          </div>


    </main>
    </body>

</html>
<script>
  hljs.initHighlightingOnLoad();
</script>