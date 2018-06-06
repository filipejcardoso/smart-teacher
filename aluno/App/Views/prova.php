<?php
if(!isset($_SESSION))
     session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
    <?php include("_includes/geral.php"); ?>
    <link rel="stylesheet" href="/App/Views/_includes/_css/prova.css">
    </head>
    
    <body>
      <main>

        <div class="prova_info">
          <div class="col s12 center"><h6>TEMPO RESTANTE</h6></div>
          <div class="col s12 center"><h4><span id="tempo_restante"></span></h4></div>

          <center>
              <a href="#modal1" name='btn_login' class='waves-effect waves-light btn-flat teal darken-4 white-text modal-trigger options_prova'>
              FINALIZAR</a>
          </center>

        </div>


        <!-- Modal Trigger Finalizar 
        <a class="waves-effect waves-light btn" href="#modal1">Modal</a>-->

       <!-- Modal Structure  Finalizar-->
        <div id="modal1" class="modal">
        
          <div class="modal-content">
            <h4>Tem certeza que deseja finalizar?</h4>
            <p>Sua prova será finalizada e você não irá conseguir fazer mais alterações.</p>
          </div>
        
          <div class="modal-footer">
              <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat ">NÃO</a>
              <a onclick="finalizar();" class="modal-action modal-close waves-effect waves-green btn-flat ">SIM</a>
          </div>
        </div>

        <div class="row all_questions">
          <div class="col s12">
          <center><h3>BOA PROVA</h3></center>
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
                <?php echo "<br/>".$questao_texto->getCodigo(); ?>
              </code>
              </pre>
            </div>
            <?php } ?>


            <?php $k++; } ?>

            <div class="col s12 box_answer">
              <?php $j=1; foreach ($respostas[$i] as $resposta) {?>
              <p class="box_answer_col grey lighten-2">
                <input onchange="updateQuestoes('<?php echo $sala_questoes[$i]->getId();?>','<?php echo $resposta->getId();?>')" name="group_answer<?php echo $i;?>" type="radio" id="radio<?php echo $i; echo $j; ?>" <?php if($sala_questoes[$i]->getResposta() == $resposta->getId()) echo "checked"; ?> />
                <label for="radio<?php echo $i; echo $j; ?>" class="grey-text text-darken-3 box_answer_label"><?php echo $resposta->getTexto();?></label>
              </p>
              <?php $j++; } ?>
              <p class="box_answer_col grey lighten-2">
                <input onchange="updateQuestoes('<?php echo $sala_questoes[$i]->getId();?>','0')" name="group_answer<?php echo $i;?>" type="radio" id="radio_not_<?php echo $i; ?>" <?php if($sala_questoes[$i]->getResposta() == 0) echo "checked"; ?>/>
                <label for="radio_not_<?php echo $i; ?>" class="grey-text text-darken-2 box_answer_label"><strong>NÃO RESPONDER</strong></label>
              </p>
            </div>
          </div>
          <?php $i++;} ?>

          </div>
          </div>

      </main>
    <input type="hidden" id="sala_ajax" value="<?php echo $_SESSION['sala']; ?>">
    </body>
</html>
<script>
hljs.initHighlightingOnLoad();

var sala = $("#sala_ajax").val();

function finalizar()
{
  window.location = '/nota';
}

function atualizar()
{
  $.ajax({type: "GET", url: "/temporeal_tempo-request?sala="+sala, async:false,
    success: function(value)
    {
        $("#tr").remove();

        $("<span id='tr'>"+value+"</span>").appendTo("#tempo_restante");
    }});

    $.ajax({type: "GET", url: "/temporeal_finalizado-request?sala="+sala, async:false,
    success: function(value)
    {
        if(value == 0)
          finalizar();
    }});

}

function updateQuestoes(id,resposta)
{
    $.ajax({type: "GET", url: "/prova_update-request?id="+id+"&resposta="+resposta, async:false});

}

atualizar();

setInterval(atualizar,800);

$(document).ready(function(){
    $('.modal').modal();
  });


</script>