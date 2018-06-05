<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
    <?php include("_includes/geral.php"); ?>
    <link rel="stylesheet" href="/App/Views/_includes/_css/temporeal.css">
    </head>
    
    <body>

      <?php include("_includes/_sidenav/sidenav.php"); ?>

      <main>
        <!-- CABEÇALHO --> 
        <?php include("_includes/_cabecalho/cabecalho.php"); ?>

        <div class="row box_temporeal_info">
          <div class="col s12 center"><h5><?php echo $sala->getDescricao()." (".$sala->getId().")";; ?></h5></div>
          <div class="col s12 center"><h6><?php echo $sala->getDisciplina(); ?></h6></div>
          <div class="col s12 center"><h6>STATUS: <?php if($sala->getStatus()==1) echo "ESPERANDO LIBERAÇÃO"; else echo "EM PROGRESSO"; ?></h6></div>
        </div>
        
        <div class="row box_temporeal_alunos">
          <div class="col s12 center"><h5>ALUNOS</h5></div>
          <div class="col s4 center"><h5>TOTAL: <span id="alunos_total"></span></h5></div>
          <div class="col s4 center"><h5>FINALIZADO: <span id="alunos_finalizado"></span></h5></div>
          <div class="col s4 center"><h5>RESTANTE: <span id="alunos_restante"></span></h5></div>
        </div>
        
        <div class="row box_temporeal_tempo">
          <div class="col s12 center"><h5>TEMPO RESTANTE</h5></div>
          <div class="col s12 center"><h2><span id="tempo_restante"></span></h2></div>
        </div>
        
        <div class="row box_temporeal_opcoes">
          <div class="col s12 center"><h5>OPÇÕES</h5></div>
          <div class="col s12 center">
          <form method="post" action="/liberarsala-request">
              <input type="hidden" name="sala_liberar" value="<?php echo $sala->getId(); ?>">
              <button type='submit' name='btn_login' class='waves-effect waves-light btn-flat green white-text options_temporeal'<?php if($sala->getStatus()==2)echo "disabled"; ?>>
              <i class="material-icons left">done_all</i>LIBERAR INICIO</button>
          </form>
          </div>
          <div class="col s12 center">
          <form method="post" action="/finalizarsala-request">
              <input type="hidden" name="sala_finalizar" value="<?php echo $sala->getId(); ?>">
              <button type='submit' id="bt_finalizar" name='btn_login' class='waves-effect waves-light btn-flat red white-text options_temporeal'>
              <i class="material-icons left">done_all</i>FINALIZAR</button>
          </form>
          </div>
        </div>

      </main>

      <!-- RODAPÉ -->
      <?php include("_includes/_rodape/rodape.php"); ?>
    <input type="hidden" id="sala_ajax" value="<?php echo $sala->getId(); ?>">
    </body>
</html>
<script>
var sala = $("#sala_ajax").val();
function atualizar()
{
  $.ajax({type: "GET", url: "/temporeal_alunos-request?sala="+sala, async:false,
    success: function(value)
    {
        value_split = value.split("&");
        
        $("#at").remove();
        $("#af").remove();
        $("#ar").remove();
        
        $("<span id='at'>"+(value_split[0])+"</span>").appendTo("#alunos_total");
        $("<span id='af'>"+value_split[1]+"</span>").appendTo("#alunos_finalizado");
        $("<span id='ar'>"+value_split[2]+"</span>").appendTo("#alunos_restante");

    }});

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
          $("#bt_finalizar").click();
    }});
}

atualizar();
setInterval(atualizar,800)

</script>
